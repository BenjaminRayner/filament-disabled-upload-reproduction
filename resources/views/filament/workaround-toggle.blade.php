<label>
    <input
        type="checkbox"
        class="fi-checkbox-input"
        @checked(request()->boolean('workarounds'))
        onchange="
            const url = new window.URL(window.location.href);
            this.checked
                ? url.searchParams.set('workarounds', '1')
                : url.searchParams.delete('workarounds');
            window.location.assign(url);
        "
    >
    Apply CSS workaround
</label>
