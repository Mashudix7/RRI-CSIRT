    </main>
</div>
</div>

<?php $this->load->view('admin/templates/modal_confirm'); ?>
<?php $this->load->view('admin/templates/modal_flash'); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 500, // Slightly faster AOS
        offset: 30,    // Trigger sooner
        disable: 'mobile' 
    });

    // Number Counting Animation
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

    // Initialize counters on load
    document.addEventListener('DOMContentLoaded', animateCounters);
</script>
</body>
</html>
