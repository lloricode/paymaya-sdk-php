<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;

class MetaDataRequest extends BaseRequest
{
    private string $smi;
    private string $smn;
    private string $mci;
    private string $mpc;
    private string $mco;
    private ?string $mst = null;

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
    public function jsonSerialize()
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
