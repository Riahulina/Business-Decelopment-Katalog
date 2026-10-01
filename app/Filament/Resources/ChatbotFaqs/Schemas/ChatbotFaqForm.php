<?php

namespace App\Filament\Resources\ChatbotFaqs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ChatbotFaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Umum'     => 'Umum',
                        'Produk'   => 'Produk',
                        'Reseller' => 'Reseller',
                        'Kontak'   => 'Kontak',
                    ])
                    ->default('Umum')
                    ->required(),

                TextInput::make('sort_order')
                    ->label('Urutan Tampil')
                    ->required()
                    ->numeric()
                    ->default(fn() => (\App\Models\ChatbotFaq::max('sort_order') ?? 0) + 1),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('FAQ nonaktif tidak akan muncul di chatbot.'),
            ]);
    }
}
