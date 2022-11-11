<?php

namespace App\Actions\VoyagerActions;


use App\Models\Candidate;
use TCG\Voyager\Actions\AbstractAction;

class ConvertCandidateAction extends AbstractAction
{

    public function getTitle()
    {
        return 'Convert';
    }

    public function getIcon()
    {
        return 'voyager-person';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right edit',
            'style' => 'margin-right: 5px'
        ];
    }

    public function getDefaultRoute()
    {
        return route('candidate.convert', ['id' => $this->data->id]);
    }

    /**
     * @param  Candidate  $candidate
     * @return bool
     */
    public function shouldActionDisplayOnRow($candidate)
    {
        return !$candidate->trashed();
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->model_name == Candidate::class;
    }
}
