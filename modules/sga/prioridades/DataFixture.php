<?php
namespace modules\sga\prioridades;

use Exception;
use Novosga\Context;
use Novosga\Model\Prioridade;

/**
 * Prioridades DataFixture
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class DataFixture {
    
    /**
     * 
     * @param \Novosga\Context $context
     * @throws Exception
     */
    public function install(Context $context) {
        $em = $context->database()->createEntityManager();
        try {
            $em->beginTransaction();
            $em->persist($this->create(_('Sem prioridade'), _('Atendimento normal'), 0));
            $em->persist($this->create(_('Portador de Deficiência'), _('Atendimento prioritáro para portadores de deficiência'), 1));
            $em->persist($this->create(_('Gestante'), _('Atendimento prioritáro para gestantes'), 1));
            $em->persist($this->create(_('Idoso'), _('Atendimento prioritáro para idosos'), 1));
            $em->persist($this->create(_('Outros'), _('Qualquer outra prioridade'), 1));
            $em->commit();
            $em->flush();
        } catch (Exception $e) {
            try {
                $em->rollback();
            } catch (Exception $ex) {
            }
            throw $e;
        }
    }
    
    /**
     * 
     * @param string $name
     * @param string $description
     * @param integer $weight
     * @return \Novosga\Model\Prioridade
     */
    public function create($name, $description, $weight) {
        $prioridade = new Prioridade();
        $prioridade->setNome($name);
        $prioridade->setDescricao($description);
        $prioridade->setPeso($weight);
        $prioridade->setStatus(1);
        return $prioridade;
    }
    
}