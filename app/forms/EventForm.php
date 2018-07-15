<?php

namespace ZelPage;

use \Nette\Application\UI\Form;
use \Nette\ComponentModel\IContainer;
use \Nette\Utils\Html;

class EventForm extends Form {

    /** @var callable[] */
    public $onEventSaved;

    public function __construct(IContainer $parent = NULL, $name = NULL) {
        parent::__construct($parent, $name);

        $this->addGroup('Údaje o akci');

        $this->addHidden('event_id');

        $typy_akci = [
            'modely' => 'modelářská akce',
            'vystava' => 'výstava',
            'konference' => 'konference',
        ];
        $this->addRadioList('druh', 'typ akce', $typy_akci)
            ->getSeparatorPrototype()->setName(null);
        $this['druh']->setDefaultValue('modely');

        //fix
        $zamereni_akci = [
            'soto' => 'šoto',
        ];
        $this->addRadioList('typ', 'zaměření akce', $typy_akci)
            ->getSeparatorPrototype()->setName(null);
        $this['typ']->setDefaultValue('soto');

        $this->addText('jmeno', 'Název')
            ->setRequired('Vyplňte název akce.');

        $this->addText('od', 'počáteční datum')
            ->setType('date')
            ->setRequired('Vyplňte počáteční datum akce');

        $this->addText('do', 'koncové datum')
            ->setType('date')
            ->setRequired('Vyplňte koncové datum akce');

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

        $this->addTextarea('misto', 'místo konání akce')
            ->setOption('description', Html::el('p')
                ->setHtml('např.: Zababov žst., kulturní sál')
            );

        $this->addTextarea('p_cz', 'popis v češtině');
        $this->addTextarea('p_sk', 'popis ve slovenštině');
        $this->addTextarea('p_de', 'popis v němčině');
        $this->addTextarea('p_en', 'popis v angličtině');
        $this->addTextarea('p_pl', 'popis v polštině');

        //pořadatel
        //země
        //kraj
        //odkazy

        $this->addSubmit('ok', 'OK');
    }

}
