jQuery(document).ready(function($) {
    $('.sale-countdown-timer').each(function() {
        const timerElement = $(this);
        const saleEndTimestamp = parseInt(timerElement.data('sale-end'), 10);

        if (saleEndTimestamp) {
            const saleEndDate = new Date(saleEndTimestamp * 1000); // Convert to milliseconds

            const updateCountdown = () => {
                const now = new Date();
                const timeLeft = saleEndDate - now;

                if (timeLeft > 0) {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    timerElement.html(`
                        <div class="timer">
                            <span class="days">${days}d</span>
                            <span class="hours">${hours}h</span>
                            <span class="minutes">${minutes}m</span>
                            <span class="seconds">${seconds}s</span>
                        </div>
                    `);
                } else {
                    timerElement.html('<span class="expired">Sale Ended!</span>');
                }
            };

            // Initial call and update every second
            updateCountdown();
            setInterval(updateCountdown, 1000);
        }
    });
});