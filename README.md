# Disabled file-upload spacing reproduction

Filament 5.11.1, Laravel 13.40.0, Livewire 4.4.8, PHP 8.5.12. Based on Filament's official 5.x reproduction template.

## Setup

```sh
git clone https://github.com/BenjaminRayner/filament-disabled-upload-reproduction.git
cd filament-disabled-upload-reproduction
composer setup
php artisan serve
```

Log in at `/admin` with `test@example.com` / `password` (local template credentials). Open **Examples** and select the seeded record. Standard list, create, edit, and view resource pages are available.

## Reproduce

1. Open the seeded **Disabled upload example** record for editing. Its populated `FileUpload` is enabled and displays its normal upload prompt.
2. Open the record's **View** page. Filament disables the same form automatically.
3. The existing document is visible, but an empty `.filepond--drop-label` reserves approximately 67px above it. Chromium measures the total field height as 111px.
4. Append `?workarounds=1` to the view page and reload. The drop label is hidden before FilePond initializes, reducing the field height to 44px.
5. Open the edit page with `?workarounds=1`. The enabled upload retains its label and original height.

Field configuration:

```php
FileUpload::make('documents')
    ->disk('local')
    ->multiple()
    ->previewable(false);
```

There is no custom page, custom page template, or media-library integration. The resource uses standard list, create, edit, and view pages. The view page uses Filament's default disabled form. The model's JSON column stores file paths; the seeder creates a synthetic local document.

## Workaround

`public/workarounds.css` contains only the disabled-upload override. An optional panel head hook loads it when `?workarounds=1` is present. Default pages use stock Filament styles.

Applying the override after FilePond initializes hides the label but leaves cached layout space until reinitialization. Reloading ensures the override is present during initialization.

## Screenshots

Enabled edit form: [screenshot](public/edit-before.png).

Disabled view form: [before](public/view-before.png) / [after](public/view-after.png).

## Verification

Verified in Chromium: the disabled field shrinks from 111px to 44px; the enabled edit field retains its label. Resource create and edit submissions were also checked for persistence.
