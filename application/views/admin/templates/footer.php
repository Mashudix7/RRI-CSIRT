    </main>
</div>
</div>

<?php $this->load->view('admin/templates/modal_confirm'); ?>
<?php $this->load->view('admin/templates/modal_flash'); ?>
<?php $this->load->view('admin/templates/session_monitor'); ?>
<?php $this->load->view('admin/templates/toast_notification'); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init AOS with "Once per session per page" logic - Same config as landing
        const pagePath = window.location.pathname;
        const seenKey = 'aos_seen_' + pagePath;
        
        let aosConfig = {
            once: true,
            duration: 800, // Same as landing page
            offset: 100,   // Same as landing page
            easing: 'ease-out-cubic', // Smooth easing
            mirror: false,
            anchorPlacement: 'top-bottom'
        };

        // Check if we've seen this page's animation in this session
        if (sessionStorage.getItem(seenKey)) {
            // Already seen: Disable animation to keep it static/prevent re-run
            aosConfig.disable = true;
        } else {
            // First time: Mark as seen
            sessionStorage.setItem(seenKey, 'true');
        }

        AOS.init(aosConfig);
        
        animateCounters();
    });
    function animateCounters() {
        const counters = document.querySelectorAll('[data-count-up]');
        const speed = 2000; // The lower the slower

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-count-up'); // Get target number
                    // Remove non-numeric chars for calculation if original text had them (though we'll replace text)
                    
                    let count = 0;
                    const inc = target / (60); // 60 frames roughly

                    const updateCount = () => {
                        if (count < target) {
                            count += inc;
                            // Format number with commas/dots if needed
                            counter.innerText = Math.ceil(count).toLocaleString('id-ID');
                            requestAnimationFrame(updateCount);
                        } else {
                            counter.innerText = target.toLocaleString('id-ID');
                        }
                    };

                    updateCount();
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 }); // Trigger when 50% visible

        counters.forEach(counter => observer.observe(counter));
    }
</script>
</body>
</html>
