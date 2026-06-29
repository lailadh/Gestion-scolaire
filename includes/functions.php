<?php

function h($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function messageErreurBD(PDOException $e, string $contexteSuppression = ''): string
{
    if ($e->getCode() === '23000') {

        $message = $e->getMessage();

        if (stripos($message, 'Duplicate entry') !== false) {
            return "Cette valeur existe déjà.";
        }

        if (
            stripos($message, 'foreign key') !== false ||
            stripos($message, 'a foreign key constraint fails') !== false
        ) {
            return $contexteSuppression !== ''
                ? $contexteSuppression
                : "Impossible de supprimer cet élément car il est utilisé dans d'autres données.";
        }
    }

return "Une erreur est survenue. Veuillez réessayer.";}