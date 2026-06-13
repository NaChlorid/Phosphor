<?php
namespace Pterodactyl\Http\Controllers\Admin\Extensions\phosphor;

use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\View;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Admin\BlueprintAdminLibrary as BlueprintExtensionLibrary;

class phosphorExtensionController extends Controller
{
    public function __construct(
        private ViewFactory $view,
        private BlueprintExtensionLibrary $blueprint,
    ) {}

    private function bgFile(): string {
        return base_path('storage/app/phosphor_bg.txt');
    }

    public function index(Request $request): View
    {
        $bgImage = file_exists($this->bgFile()) ? trim(file_get_contents($this->bgFile())) : '';

        return $this->view->make('admin.extensions.phosphor.index', [
            'blueprint' => $this->blueprint,
            'background_image' => $bgImage,
        ]);
    }

    public function post(Request $request)
    {
        if ($request->has('reset_background')) {
            file_put_contents($this->bgFile(), '');
            return redirect()->back()->with('success', 'Background reset to default.');
        }

        if ($request->hasFile('background_image')) {
            $request->validate([
                'background_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            $path = $request->file('background_image')->store('extensions/phosphor', 'public');
            file_put_contents($this->bgFile(), '/storage/' . $path);
        }

        return redirect()->back()->with('success', 'Background updated.');
    }
}
