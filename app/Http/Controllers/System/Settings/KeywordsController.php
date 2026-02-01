<?php

namespace App\Http\Controllers\System\Settings;

use App\Http\Controllers\Controller;
use App\Models\Core\Keyword;
use App\Services\Shared\Filters;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KeywordsController extends Controller{
    protected string $_path = 'system/app/settings/keywords/';

    /**
     * Get all keywords from Models
     * @return View
     */
    public function index(): View{
        return view($this->_path.'index', [
            'keywords' => Keyword::getKeywords()
        ]);
    }

    /**
     * Preview single keyword; All samples
     * @param $key
     * @return View
     */
    public function previewInstances($key): View{
        $instances = Keyword::where('type', $key);
        $instances = Filters::filter($instances);
        $filters = [
            'name' => __('Vrijednost'),
            'description' => __('Kratki opis'),
            'value' => __('Specijalna vrijednost')
        ];

        return view($this->_path.'preview-instances', [
            'instances' => $instances,
            'filters' => $filters,
            'keyword' => Keyword::getKeyword($key),
            'key' => $key
        ]);
    }

    /**
     * Add new sample
     * @param $key
     * @return View
     */
    public function newInstance($key): View{
        return view($this->_path.'create', [
            'keyword' => Keyword::getKeyword($key),
            'key' => $key,
            'create' => true
        ]);
    }

    /**
     * Save new sample
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveInstance(Request $request): RedirectResponse{
        try{
            Keyword::create($request->except(['_token']));
            return redirect()->route('system.admin.core.keywords.preview-instances', ['key' => $request->type])->with('success', __('Uspješno sačuvano!'));
        }catch (\Exception $e){ return back(); }
    }

    /**
     * Edit sample
     * @param $id
     * @return View
     */
    public function editInstance($id): View{
        $instance = Keyword::where('id', $id)->first();
        $key = $instance->type;

        return view($this->_path.'create', [
            'keyword' => Keyword::getKeyword($key),
            'key' => $key,
            'edit' => true,
            'instance' => $instance
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateInstance(Request $request): RedirectResponse{
        try{
            Keyword::where('id', $request->id)->update($request->except(['_token', '_method', 'id']));
            return redirect()->route('system.settings.keywords.preview-instances', ['key' => $request->type])->with('success', __('Uspješno ažurirano!'));
        }catch (\Exception $e){ }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteInstance($id): RedirectResponse{
        try{
            $keyword = Keyword::where('id', $id)->first();
            $key = $keyword->type;
            $name = $keyword->name;

            $keyword->delete();

            return redirect()->route('system.settings.keywords.preview-instances', ['key' => $key])->with('success', __('Uspješno izbrisana instanca:') . $name . "!");
        }catch (\Exception $e){
            return redirect()->route('system.settings.keywords.preview-instances', ['key' => $key])->with('error', __('Desila se greška prilikom brisanja instance instanca:') . $name . ", molimo pokušajte ponovo!");
        }
    }
}
