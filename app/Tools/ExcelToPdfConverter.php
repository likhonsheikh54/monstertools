<?php

namespace App\Tools;

use App\Models\Tool;
use Illuminate\Http\Request;
use App\Traits\ToolsPostAction;
use App\Components\ToolsManager;
use App\Contracts\ToolInterface;
use App\Traits\LibreofficeFields;

class ExcelToPdfConverter implements ToolInterface
{
    use LibreofficeFields, ToolsPostAction;

    public function render(Request $request, Tool $tool)
    {
        return view('tools.excel-pdf-converter', compact('tool'));
    }

    public function handle(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'files' => "required|max:{$tool->no_file_tool}",
            'files.*' => "required|mimes:xls,xlsx|max:" . convert_mb_into_kb($tool->fs_tool)
        ]);

        $driver = (new ToolsManager($tool))->driver();
        if (method_exists($driver, 'setTask')) {
            $driver->setTask('officepdf');
        }
        $result = $driver->parse($request);

        if (!$result['success']) {
            return redirect()->back()->withErrors($result['message']);
        }

        $results = [
            'files' => $result['files'],
            'process_id' => $result['process_id']
        ];

        return view('tools.excel-pdf-converter', compact('results', 'tool'));
    }
}
