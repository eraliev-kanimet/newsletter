<?php

namespace App\Helpers\Filament;

use Closure;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Collection;
use Riodwanto\FilamentAceEditor\AceEditor;

class FilamentFormHelper
{
    public function tabs(array|Closure $tabs): Tabs
    {
        return Tabs::make('')->tabs($tabs);
    }

    public function tab(string $header, array $schema): Tabs\Tab
    {
        return Tabs\Tab::make($header)->schema($schema);
    }

    public function input(string $model): TextInput
    {
        return TextInput::make($model);
    }

    public function textarea(string $model): Textarea
    {
        return Textarea::make($model)->notRegex('/.(<script|<style>).+/i');
    }

    public function repeater(string $model, array $schema): Repeater
    {
        return Repeater::make($model)->schema($schema);
    }

    public function fieldset(string $header, array $schema, int $columns = 1): Fieldset
    {
        return Fieldset::make($header)->schema($schema)->columns($columns);
    }

    public function tags(string $model): TagsInput
    {
        return TagsInput::make($model);
    }

    public function toggle(string $model): Toggle
    {
        return Toggle::make($model);
    }

    public function select(string $model): Select
    {
        return Select::make($model)->native(false);
    }

    public function image(string $model): FileUpload
    {
        return FileUpload::make($model)->image();
    }

    public function grid(array $schema, array|int $columns = 2): Grid
    {
        return Grid::make($columns)->schema($schema);
    }

    public function radio(string $model, array|callable $options = []): Radio
    {
        return Radio::make($model)->options($options);
    }

    public function checkbox(string $model, array|Collection $options = []): CheckboxList
    {
        return CheckboxList::make($model)->options($options);
    }

    public function dateTime(string $model): DateTimePicker
    {
        return DateTimePicker::make($model)->native(false);
    }

    public function hidden(string $model)
    {
        return Hidden::make($model);
    }

    public function aceEditor(string $model, string $mode = 'html'): AceEditor
    {
        return AceEditor::make($model)
            ->mode($mode)
            ->theme('github')
            ->darkTheme('dracula');
    }

    public function keyValue(string $model): KeyValue
    {
        return KeyValue::make($model);
    }
}
