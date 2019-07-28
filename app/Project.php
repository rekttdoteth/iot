<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Project extends Model
{
    //
    use Taggable;
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'external_link'];
    public function researches()
    {
    	return $this->belongsToMany('App\Research', 'research_project');
    }

    public function collaborators()
    {
    	return $this->belongsToMany('App\Collaborator', 'project_collaborator');
    }

    public function publications()
    {
    	return $this->belongsToMany('App\Publication', 'project_publication');
    }

    public function awards()
    {
    	return $this->belongsToMany('App\Award', 'project_award');
    }

    public function fundings()
    {
    	return $this->hasMany('App\Funding', 'fundings');
    }

    public function researchers()
    {
    	return $this->belongsToMany('App\Researcher','project_researcher');
    }
}
