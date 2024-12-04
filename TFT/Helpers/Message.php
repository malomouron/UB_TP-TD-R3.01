<?php
declare(strict_types=1);

namespace Helpers;

/**
 * Classe Message pour gérer les messages avec titre et couleur.
 */
class Message
{
    /**
     * @var string $message Contenu du message.
     */
    private string $message;

    /**
     * @var string $color Couleur du message.
     */
    private string $color;

    /**
     * @var string $title Titre du message.
     */
    private string $title;

    private const MESSAGE_COLOR_SUCCESS = '#28a745';
    private const MESSAGE_COLOR_ERROR = '#dc3545';
    private const MESSAGE_COLOR_WARNING = '#ffc107';
    private const MESSAGE_COLOR_INFO = '#d4af37';

    /**
     * Constructeur : initialise le message, le titre et la couleur.
     *
     * @param string $message Contenu du message.
     * @param string $title Titre du message.
     * @param string $color Couleur du message (par défaut vide).
     */
    public function __construct(string $message, string $title, string $color = "")
    {
        $this->message = $message;
        $this->title = $title;
        switch ($color) {
            case 'success':
                $this->color = self::MESSAGE_COLOR_SUCCESS;
                break;
            case 'error':
                $this->color = self::MESSAGE_COLOR_ERROR;
                break;
            case 'warning':
                $this->color = self::MESSAGE_COLOR_WARNING;
                break;
            default:
                $this->color = self::MESSAGE_COLOR_INFO;
                break;
        }
    }

    /**
     * Récupère le contenu du message.
     *
     * @return string Contenu du message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Récupère la couleur du message.
     *
     * @return string Couleur du message.
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Récupère le titre du message.
     *
     * @return string Titre du message.
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}