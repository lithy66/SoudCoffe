<?php

use Illuminate\Contracts\Pagination\Paginator;

function getFolder()
{
   return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

function getFolderJs(){
    return config('app.languages') == 'ar' ? 'css-rtl' : 'css';
}


