<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Konten')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(?string $state, Set $set) => $set('slug', Str::slug($state ?? ''))),

                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Select::make('category')
                        ->label('Kategori')
                        ->options([
                            'Pengumuman' => 'Pengumuman',
                            'Acara'      => 'Acara',
                            'Promo'      => 'Promo',
                            'Kolaborasi' => 'Kolaborasi',
                            'Peluang'    => 'Peluang',
                        ])
                        ->default('Pengumuman')
                        ->required(),

                    Textarea::make('excerpt')
                        ->label('Ringkasan')
                        ->rows(3)
                        ->required()
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->label('Isi artikel')
                        ->required()
                        ->toolbarButtons(['h2', 'h3', 'bold', 'italic', 'bulletList', 'orderedList', 'link', 'undo', 'redo'])
                        ->columnSpanFull(),
                ]),

            Section::make('Kutipan (opsional)')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    Textarea::make('quote')
                        ->label('Kutipan')
                        ->rows(3),

                    TextInput::make('quote_author')
                        ->label('Nama pengutip'),
                ]),

            Section::make('Media & info')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    FileUpload::make('cover_image')
                        ->label('Cover')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('news'),

                    FileUpload::make('attachment')
                        ->label('Lampiran PDF (opsional)')
                        ->disk('public')
                        ->visibility('public')
                        ->directory('news/files')
                        ->acceptedFileTypes(['application/pdf']),

                    TextInput::make('source')
                        ->label('Media')
                        ->default('Website BD'),

                    Select::make('status')
                        ->options([
                            'draft'     => 'Draft',
                            'published' => 'Published',
                        ])
                        ->default('draft')
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->label('Tanggal terbit')
                        ->default(now()),
                ]),

        ]);
    }
}
