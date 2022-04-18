<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;

class MetaData extends Base
{
    public ?string $smi = null;
    public ?string $smn = null;
    public ?string $mci = null;
    public ?string $mpc = null;
    public ?string $mco = null;
    public ?string $mst = null;

    public function setSMI(string $smi): self
    {
        $this->smi = $smi;

        return $this;
    }

    public function setSMN(string $smn): self
    {
        $this->smn = $smn;

        return $this;
    }

    public function setMCI(string $mci): self
    {
        $this->mci = $mci;

        return $this;
    }

    public function setMPC(string $mpc): self
    {
        $this->mpc = $mpc;

        return $this;
    }

    public function setMCO(string $mco): self
    {
        $this->mco = $mco;

        return $this;
    }

    public function setMST(string $mst): self
    {
        $this->mst = $mst;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'smi' => $this->smi,
            'smn' => $this->smn,
            'mci' => $this->mci,
            'mpc' => $this->mpc,
            'mco' => $this->mco,
            'mst' => $this->mst,
        ];
    }
}
