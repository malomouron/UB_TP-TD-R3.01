<?php
declare(strict_types=1);
namespace Helpers;

class Message
{
    private string $message;
    private string $color;
    private string $title;

    private const MESSAGE_COLOR_SUCCESS = '#28a745';
    private const MESSAGE_COLOR_ERROR = '#dc3545';
    private const MESSAGE_COLOR_WARNING = '#ffc107';
    private const MESSAGE_COLOR_INFO = '#d4af37';

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }



    public function __construct(string $message, string $title, string $color = "")
    {
        $this->message = $message;
        $this->color = $color;
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
}