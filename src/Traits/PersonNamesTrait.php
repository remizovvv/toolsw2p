<?php

namespace Omadonex\ToolsW2p\Traits;

trait PersonNamesTrait
{
    protected function getDefaultNameAttribute()
    {
        return 'Пользователь';
    }

    /**
     * Полное обращение к человеку (Имя Фамилия и Отчество)
     * @return string
     */
    public function getFullNameAttribute()
    {
        $str = $this->fname . ' ' . $this->sname . ' ' . $this->tname;

        return $str ?: $this->getDefaultNameAttribute();
    }

    /**
     * Короткое обращение к человеку (Имя и Фамилия)
     * @return string
     */
    public function getShortNameAttribute()
    {
        $str = $this->fname . ' ' . $this->sname;

        return $str ?: $this->getDefaultNameAttribute();
    }

    /**
     * Официальное обращение к человеку (Имя и Отчество)
     * @return string
     */
    public function getOfficialNameAttribute()
    {
        $str = $this->fname . ' ' . $this->tname;

        return $str ?: $this->getDefaultNameAttribute();
    }

    /**
     * Фамилия, инициалы
     * @return string
     */
    public function getInitialsNameAttribute()
    {
        $str = $this->sname . ' ' . $this->fname[0]  . '.' . $this->tname[0] . '.';

        return $str ?: $this->getDefaultNameAttribute();
    }
}
