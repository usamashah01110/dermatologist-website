{{-- Reusable password show/hide eye toggle. Place the markup below inside an
     .input-with-icon wrapper, give the password <input> the class "has-eye",
     and add a <button class="pw-eye" data-target="INPUT_ID">. Then @include this
     partial once per page (it injects the styles and the wiring script). --}}
<style>
    .input-with-icon .has-eye { padding-right: 42px; }

    .input-with-icon .pw-eye {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-light, #6B8FA8);
        cursor: pointer;
        padding: 6px 8px;
        font-size: .9rem;
        line-height: 1;
        z-index: 3;
        border-radius: 6px;
        transition: color .2s ease;
    }

    .input-with-icon .pw-eye:hover { color: var(--primary, #1565C0); }
</style>

@push('scripts')
<script>
    // Wire up every .pw-eye button on the page to toggle its target field.
    (function () {
        document.querySelectorAll('.pw-eye').forEach(function (btn) {
            var input = document.getElementById(btn.dataset.target);
            if (!input) return;
            var icon = btn.querySelector('i');

            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                if (icon) {
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            });
        });
    })();
</script>
@endpush
