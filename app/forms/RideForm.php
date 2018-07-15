<?php

namespace ZelPage;

use \Nette\Application\UI\Form;
use \Nette\ComponentModel\IContainer;
use \Nette\Utils\Html;

class RideForm extends Form {

    /** @var callable[] */
    public $onEventSaved;

    public function __construct(IContainer $parent = NULL, $name = NULL) {
        parent::__construct($parent, $name);

        $this->addGroup('Údaje o jízdě');

        $this->addHidden('ride_id');

        //fix
        $zamereni_jizd = [
            'soto' => 'šoto',
        ];
        $this->addRadioList('typ', 'zaměření jízdy', $typy_jizd)
            ->getSeparatorPrototype()->setName(null);
        $this['typ']->setDefaultValue('soto');

        $this->addText('jmeno', 'Název')
            ->setRequired('Vyplňte název jízdy.');

        $this->addText('nostalgieCD', 'Kód v přehledu nostalgie ČD');

        $this->addText('od', 'počáteční datum')
            ->setType('date')
            ->setRequired('Vyplňte počáteční datum jízdy');

        $this->addText('do', 'koncové datum')
            ->setType('date')
            ->setRequired('Vyplňte koncové datum jízdy');

        //fix
        $jizdne_akci = [
            'soto' => 'šoto',
        ];
        $this->addRadioList('jizdne', 'jízdné', $jizdne_akci)
            ->getSeparatorPrototype()->setName(null);
        $this['jizdne']->setDefaultValue('soto');

        //fix
        $zpracovani_akci = [
            'soto' => 'šoto',
        ];
        $this->addRadioList('typ', 'aktuální stav zpracování', $zpracovani_akci)
            ->getSeparatorPrototype()->setName(null);
        $this['typ']->setDefaultValue('soto');

        $zobrazeni_akci = [
            'y' => 'ano',
            'n' => 'ne',
        ];
        $this->addRadioList('zobraz', 'zobrazení akce', $zobrazeni_akci)
            ->getSeparatorPrototype()->setName(null);
        $this['zobraz']->setDefaultValue('n');

        $this->addTextarea('trasa', 'trasa jízdy a případný JŘ')
            ->setOption('description', Html::el('p')
                ->setHtml('např.: Zababov žst., kulturní sál')
            );

        //tratě

        $this->addTextarea('p_cz', 'popis v češtině');
        $this->addTextarea('p_sk', 'popis ve slovenštině');
        $this->addTextarea('p_de', 'popis v němčině');
        $this->addTextarea('p_en', 'popis v angličtině');
        $this->addTextarea('p_pl', 'popis v polštině');

        //pořadatel
        //vozidla
        //země
        //kraj
        //odkazy

        $this->addSubmit('ok', 'OK');
    }

}
