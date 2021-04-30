{extends file='parent:_partials/footer.tpl'}

{block name='copyright_link'}
    {* debug permet d'afficher toutes les variables disponibles sur la page actuelle *}
    {debug}
    {* Commentaire en Smarty *}
    {*$shop|dump*}

    {* Pour Smarty, écrire $shop.name revient à faire $shop['name'] *}
    © {'Y'|date} - {$shop.name}
{/block}
