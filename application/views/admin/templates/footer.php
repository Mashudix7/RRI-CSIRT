    </main>
</div>
</div>

<?php $this->load->view('admin/templates/modal_confirm'); ?>
<?php $this->load->view('admin/templates/modal_flash'); ?>
<?php $this->load->view('admin/templates/session_monitor'); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init AOS with "Once per session per page" logic
        const pagePath = window.location.pathname;
        const seenKey = 'aos_seen_' + pagePath;
        
        let aosConfig = {
            once: true,
            duration: 1000, // Smooth 1s duration
            offset: 50,
            easing: 'ease-out-quart', // Premium smooth easing
            mirror: false,
            disable: 'mobile' 
        };

        // Check if we've seen this page's animation in this session
        if (sessionStorage.getItem(seenKey)) {
            // Already seen: Disable animation to keep it static/prevent re-run
            // Setting disable: true in AOS removes the aos-init/aos-animate classes immediately
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
