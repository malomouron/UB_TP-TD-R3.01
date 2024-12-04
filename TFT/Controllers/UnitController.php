<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Helpers\Message;
use InvalidArgumentException;
use League\Plates\Engine;
use Models\Origin;
use Models\OriginDAO;
use Models\UnitDAO;
use Models\Unit;

/**
 * Classe UnitController pour gérer les unités.
 */
class UnitController {
    /**
     * @var Engine $moteur Moteur de templates.
     */
    private Engine $moteur;

    /**
     * @var UnitDAO $uniteDAO Data Access Object pour les unités.
     */
    private UnitDAO $uniteDAO;

    /**
     * @var OriginDAO $origineDAO Data Access Object pour les origines.
     */
    private OriginDAO $origineDAO;

    /**
     * Constructeur : initialise le moteur de templates et les DAOs.
     *
     * @param Engine $moteur Moteur de templates.
     */
    public function __construct(Engine $moteur) {
        $this->moteur = $moteur;
        $this->uniteDAO = new UnitDAO();
        $this->origineDAO = new OriginDAO();
    }

    /**
     * Affiche le formulaire d'ajout d'une unité.
     *
     * @param array|null $parametres Paramètres de la requête.
     * @return void
     */
    public function displayAddUnit(array $parametres = null) : void {
        if (isset($parametres['error'])) {
            $message = new Message('Erreur lors de l\'ajout de l\'unité : ' . $parametres['error'], 'Erreur', 'error');
            $this->addUnitRender($message);
        } elseif (isset($parametres['action']) && $parametres['action'] == "edit-unit") {
            if (isset($parametres['id'])) {
                if (!isset($parametres['name'])) {
                    try {
                        $unite = $this->uniteDAO->getByID($parametres['id']);
                        if ($unite === null) {
                            $message = new Message('Unité non trouvée', 'Erreur', 'error');
                            $this->addUnitRender($message);
                        } else {
                            echo $this->moteur->render('add-unit', [
                                'unit' => [
                                    'id' => $unite->getId(),
                                    'name' => $unite->getName(),
                                    'cost' => $unite->getCost(),
                                    'urlimg' => $unite->getUrlImg(),
                                    'originList' => $this->uniteDAO->getOriginsForUnit($unite->getId())
                                ],
                                'originList' => $this->origineDAO->getAll()
                            ]);
                        }
                    } catch (Exception $e) {
                        $message = new Message('Erreur lors de la modification de l\'unité : ' . $e->getMessage(), 'Erreur', 'error');
                        $this->addUnitRender($message);
                    }
                } else {
                    $this->editUnit($parametres);
                }
            }
        } elseif (isset($parametres['name'])) {
            $parametres['cost'] = (int) $parametres['cost'];
            $this->addUnit($parametres);
        } else {
            $this->addUnitRender();
        }
    }

    /**
     * Affiche le formulaire de suppression d'une unité.
     *
     * @param array|null $parametres Paramètres de la requête.
     * @return void
     */
    public function displayDeleteUnit(array $parametres = null) : void {
        if (isset($parametres['error'])) {
            $message = new Message('Erreur lors de la suppression de l\'unité : ' . $parametres['error'], 'Erreur', 'error');
            $this->index($message);
        } else {
            $this->deleteUnit($parametres['id']);
        }
    }

    /**
     * Affiche le formulaire d'ajout d'une origine.
     *
     * @param array|null $parametres Paramètres de la requête.
     * @return void
     */
    public function displayAddOrigin(array $parametres = null) : void {
        if (isset($parametres['error'])) {
            $message = new Message('Erreur lors de l\'ajout de l\'origine : ' . $parametres['error'], 'Erreur', 'error');
            echo $this->moteur->render('add-origin', ['message' => $message]);
        } elseif (isset($parametres['name'])) {
            $this->addOrigin($parametres);
        } else {
            echo $this->moteur->render('add-origin');
        }
    }


    /**
     * Affiche le formulaire de recherche.
     *
     * @param array|null $parametres Paramètres de la requête.
     * @return void
     */
    public function displaySearch(array $parametres = null) : void {
        if (isset($parametres['search']) || isset($parametres['origin'])) {
            $this->search($parametres);
        } else {
            echo $this->moteur->render('search');
        }
    }

    /**
     * Affiche la page d'accueil avec toutes les unités.
     *
     * @param Message $message Message à afficher.
     * @return void
     */
    public function index(Message $message) : void {
        $toutesUnites = $this->uniteDAO->getAll();
        foreach ($toutesUnites as $unite) {
            $unite->setOrigin($this->uniteDAO->getOriginsForUnit($unite->getId()));
        }
        echo $this->moteur->render('home', [
            'tftSetName' => 'Remix Rumble',
            'resGetAll' => $toutesUnites,
            'message' => $message
        ]);
    }

    /**
     * Affiche le formulaire d'ajout d'une unité avec un message.
     *
     * @param Message|null $message Message à afficher.
     * @return void
     */
    public function addUnitRender(Message $message = null) : void {
        if ($message === null) {
            echo $this->moteur->render('add-unit', ['originList' => $this->origineDAO->getAll()]);
        } else {
            echo $this->moteur->render('add-unit', ['message' => $message, 'originList' => $this->origineDAO->getAll()]);
        }
    }








    /**
     * Ajoute une unité.
     *
     * @param array $donneesUnite Données de l'unité.
     * @return void
     */
    public function addUnit(array $donneesUnite) : void {
        try {
            $uniteData = [
                'name' => $donneesUnite['name'],
                'cost' => $donneesUnite['cost'],
                'urlImg' => $donneesUnite['urlImg'],
                'id' => uniqid()
            ];
            $unite = new Unit($uniteData);
            $this->uniteDAO->createUnit($unite);
            $listeOrigines = array_unique($donneesUnite['origin']);
            foreach ($listeOrigines as $origine) {
                if ($origine !== "") {
                    $this->uniteDAO->addOriginToUnit($unite->getId(), $origine);
                }
            }
            $message = new Message('Unité créée avec succès!', 'Succès', 'success');
        } catch (Exception $e) {
            $message = new Message('Erreur lors de la création de l\'unité : ' . $e->getMessage(), 'Erreur', 'error');
        }
        $this->addUnitRender($message);
    }

    /**
     * Modifie une unité.
     *
     * @param array $donneesUnite Données de l'unité.
     * @return void
     */
    public function editUnit(array $donneesUnite) : void {
        try {
            $donneesUnite['cost'] = (int) $donneesUnite['cost'];
            $uniteData = [
                'name' => $donneesUnite['name'],
                'cost' => $donneesUnite['cost'],
                'urlImg' => $donneesUnite['urlImg'],
                'id' => $donneesUnite['id']
            ];
            $unite = new Unit($uniteData);
            $this->uniteDAO->editUnitAndIndex($unite);
            $listeOrigines = array_unique($donneesUnite['origin']);
            $this->uniteDAO->deleteOriginForUnit($unite->getId());
            foreach ($listeOrigines as $origine) {
                if ($origine !== "") {
                    $this->uniteDAO->addOriginToUnit($unite->getId(), $origine);
                }
            }
            $message = new Message('Unité modifiée avec succès!', 'Succès', 'success');
            $this->index($message);
        } catch (Exception $e) {
            $message = new Message('Erreur lors de la modification de l\'unité : ' . $e->getMessage(), 'Erreur', 'error');
            $this->addUnitRender($message);
        }
    }

    /**
     * Supprime une unité.
     *
     * @param string $id Identifiant de l'unité.
     * @return void
     */
    public function deleteUnit(string $id) : void {
        try {
            $rowCount = $this->uniteDAO->deleteUnit($id);
            if ($rowCount === 0) {
                throw new Exception('Unité non trouvée');
            }
            $message = new Message('Unité supprimée avec succès!', 'Succès', 'success');
            $this->index($message);
        } catch (Exception $e) {
            $message = new Message('Erreur lors de la suppression de l\'unité : ' . $e->getMessage(), 'Erreur', 'error');
            $this->index($message);
        }
    }

    /**
     * Ajoute une origine.
     *
     * @param array $donneesOrigine Données de l'origine.
     * @return void
     */
    public function addOrigin(array $donneesOrigine) : void {
        try {
            $origine = new Origin($donneesOrigine);
            $this->origineDAO->createOrigin($origine);
            $message = new Message('Origine créée avec succès!', 'Succès', 'success');
        } catch (Exception $e) {
            $message = new Message('Erreur lors de la création de l\'origine : ' . $e->getMessage(), 'Erreur', 'error');
        }
        $this->index($message);
    }



    /**
     * Effectue une recherche d'unités.
     *
     * @param array $requete Paramètres de la recherche.
     * @return void
     */
    public function search(array $requete) : void {
        try {
            if (isset($requete['search']) && $requete["origin"] == "") {
                $resultats = $this->uniteDAO->searchByName($requete['search']);
                echo $this->moteur->render('search', ['results' => $resultats, 'message' => new Message('Résultats', 'Succès', 'success')]);
            } elseif (isset($requete['origin']) && $requete["search"] == "") {
                $resultats = $this->uniteDAO->searchByOrigin($requete['origin']);
                echo $this->moteur->render('search', ['results' => $resultats, 'message' => new Message('Résultats', 'Succès', 'success')]);
            } else {
                throw new InvalidArgumentException("Paramètres de recherche invalides");
            }
        } catch (InvalidArgumentException $e) {
            echo $this->moteur->render('search', ['message' => new Message($e->getMessage(), 'Erreur', 'error')]);
        } catch (Exception $e) {
            echo $this->moteur->render('search', ['message' => new Message('Erreur lors de la recherche : ' . $e->getMessage(), 'Erreur', 'error')]);
        }
    }
}