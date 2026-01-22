<!-- Global Flash Message Modal -->
<div id="flash-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="flash-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity opacity-0" id="flash-backdrop"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal Panel -->
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="flash-panel">
                
                <div class="p-6">
                    <div class="flex flex-col items-center text-center gap-4">
                        <!-- Icon -->
                        <div id="flash-icon-container" class="flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center mb-2">
                            <!-- Success Icon -->
                            <svg id="flash-icon-success" class="w-8 h-8 hidden" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            <!-- Error Icon -->
                            <svg id="flash-icon-error" class="w-8 h-8 hidden" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="flash-title"></h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400" id="flash-message"></p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 dark:bg-slate-700/30 px-6 py-4 flex justify-center">
                    <button type="button" onclick="closeFlashModal()" class="inline-flex w-full justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors sm:w-auto min-w-[120px]" id="flash-button">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Flash Data Transfer -->
<?php if ($this->session->flashdata('success')): ?>
    <div id="flash-data-success" data-message="<?= $this->session->flashdata('success') ?>" hidden></div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div id="flash-data-error" data-message="<?= $this->session->flashdata('error') ?>" hidden></div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flashSuccess = document.getElementById('flash-data-success');
    const flashError = document.getElementById('flash-data-error');
    
    if (flashSuccess) {
        showFlashModal('success', flashSuccess.dataset.message);
    } else if (flashError) {
        showFlashModal('error', flashError.dataset.message);
    }
});

function showFlashModal(type, message) {
    const modal = document.getElementById('flash-modal');
    const backdrop = document.getElementById('flash-backdrop');
    const panel = document.getElementById('flash-panel');
    
    // Elements
    const iconContainer = document.getElementById('flash-icon-container');
    const iconSuccess = document.getElementById('flash-icon-success');
    const iconError = document.getElementById('flash-icon-error');
    const title = document.getElementById('flash-title');
    const msg = document.getElementById('flash-message');
    const btn = document.getElementById('flash-button');

    // Reset styles
    iconSuccess.classList.add('hidden');
    iconError.classList.add('hidden');
    iconContainer.className = 'flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center mb-2';
    btn.className = 'inline-flex w-full justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors sm:w-auto min-w-[120px]';

    // Apply styles based on type
    if (type === 'success') {
        iconContainer.classList.add('bg-green-100', 'dark:bg-green-500/10');
        iconSuccess.classList.remove('hidden');
        iconSuccess.classList.add('text-green-600', 'dark:text-green-400');
        
        title.textContent = 'Berhasil!';
        btn.classList.add('bg-green-600', 'hover:bg-green-700');
    } else {
        iconContainer.classList.add('bg-red-100', 'dark:bg-red-500/10');
        iconError.classList.remove('hidden');
        iconError.classList.add('text-red-600', 'dark:text-red-400');
        
        title.textContent = 'Gagal!';
        btn.classList.add('bg-red-600', 'hover:bg-red-700');
    }

    msg.textContent = message;

    // Show
    modal.classList.remove('hidden');
    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }, 10);
}

window.closeFlashModal = function() {
    const modal = document.getElementById('flash-modal');
    const backdrop = document.getElementById('flash-backdrop');
    const panel = document.getElementById('flash-panel');

    backdrop.classList.add('opacity-0');
    panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
    panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
};
</script>
