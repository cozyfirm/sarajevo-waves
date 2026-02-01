<?php

namespace App\Http\Controllers\System\Settings;

use App\Http\Controllers\Controller;
use App\Models\Other\FAQ;
use App\Services\Shared\Filters;
use App\Traits\Common\FileTrait;
use App\Traits\Http\ResponseTrait;
use App\Traits\Users\UserBaseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FAQsController extends Controller{
    use UserBaseTrait, ResponseTrait, FileTrait;
    protected string $_path = 'system/app/settings/faq/';

    /**
     * Get all questions
     * @return View
     */
    public function index(): View{
        $faqs = FAQ::where('id', '>', 0);
        $faqs = Filters::filter($faqs);
        $filters = [ 'title' => __('Naziv'), 'what' => __('Sekcija') ];

        return view($this->_path . 'index', [
            'filters' => $filters,
            'faqs' => $faqs
        ]);
    }

    /**
     * @return View
     */
    public function create(): View{
        return view($this->_path . 'create', [
            'create' => true,
            'other' => [0 => 'Something', 1 => "Something else"]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse{
        try{
            $faq = FAQ::create($request->all());

            return $this->jsonSuccess(__('Uspješno ste ažurirali podatke!'), route('system.settings.faq.edit', ['id' => $faq->id]));
        }catch (\Exception $e){
            return $this->jsonError('1500', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View{
        return view($this->_path . 'create', [
            'edit' => true,
            'other' => [0 => 'Something', 1 => "Something else"],
            'faq' => FAQ::where('id', '=', $id)->first()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse{
        try{
            FAQ::where('id', '=', $request->id)->update($request->except(['id', 'undefined', 'files']));

            return $this->jsonSuccess(__('Uspješno ste ažurirali podatke!'), route('system.settings.faq.edit', ['id' => $request->id]));
        }catch (\Exception $e){
            return $this->jsonError('1500', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse{
        FAQ::where('id', '=', $id)->delete();

        return redirect()->route('system.settings.faq')->with('success', __('Uspješno obrisano!'));
    }
}
