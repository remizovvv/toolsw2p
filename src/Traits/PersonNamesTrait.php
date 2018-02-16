<?php

namespace Omadonex\ToolsW2p\Traits;

trait PersonNamesTrait
{
    /**
     * Полное обращение к человеку (Имя Фамилия и Отчество)
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . $this->sname . ' ' . $this->tname;
    }

    /**
     * Короткое обращение к человеку (Имя и Фамилия)
     * @return string
     */
    public function getShortNameAttribute()
    {
        return $this->fname . ' ' . $this->sname;
    }

    /**
     * Официальное обращение к человеку (Имя и Отчество)
     * @return string
     */
    public function getOfficialNameAttribute()
    {
        return $this->fname . ' ' . $this->tname;
    }

    public function getInitialsNameAttribute()
    {
        return $this->sname . ' ' . $this->fname[0]  . ' ' . $this->tname[0];
    }
}
