<?php

namespace Omadonex\ToolsW2p\Traits;

trait CanBeActivatedTrait
{
    private function getActiveFieldName()
    {
        $propFieldName = 'activeFieldName';
        $fieldName = property_exists($this, $propFieldName) ? $this->$propFieldName : 'active';
        return $fieldName;
    }

    public function isActive()
    {
        $fieldName = $this->getActiveFieldName();
        return $this->$fieldName;
    }

    public function setActive($active)
    {
        $fieldName = $this->getActiveFieldName();
        if ($this->$fieldName != $active) {
            $this->update([
                $fieldName => $active,
            ]);

            if ($active && method_exists($this, 'activePositiveAction')) {
                $this->activePositiveAction();
            }

            if (!$active && method_exists($this, 'activeNegativeAction')) {
                $this->activeNegativeAction();
            }
        }
    }

    public function activate()
    {
        $this->setActive(true);
    }

    public function deactivate()
    {
        $this->setActive(false);
    }

    public function canActivate()
    {
        if (method_exists($this, 'checkActivate')) {
            return $this->checkActivate();
        }

        return true;
    }

    public function canDeactivate()
    {
        if (method_exists($this, 'checkDeactivate')) {
            return $this->checkDeactivate();
        }

        return true;
    }

    public function scopeActive($query)
    {
        $fieldName = $this->getActiveFieldName();
        return $query->where($fieldName, true);
    }

    public function scopeNotActive($query)
    {
        $fieldName = $this->getActiveFieldName();
        return $query->where($fieldName, false);
    }
}
