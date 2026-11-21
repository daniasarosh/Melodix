document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // Target our existing card classes
    const cards = document.querySelectorAll('.card, .song-card, .album-card');
    
    cards.forEach(card => {
        // Create canvas container
        const canvas = document.createElement('canvas');
        canvas.width = 200; 
        canvas.height = 40;
        canvas.style.position = 'absolute';
        canvas.style.bottom = '10px';
        canvas.style.left = '10px';
        canvas.style.right = '10px';
        canvas.style.width = 'calc(100% - 20px)';
        canvas.style.height = '40px';
        canvas.style.opacity = '0';
        canvas.style.transition = 'opacity 0.3s ease';
        canvas.style.pointerEvents = 'none';
        canvas.style.zIndex = '5';
        
        // Ensure the parent card is relative so canvas doesn't break layout
        if (getComputedStyle(card).position === 'static') {
            card.style.position = 'relative';
        }
        
        card.appendChild(canvas);
        const ctx = canvas.getContext('2d');
        let animationId = null;
        let time = 0;

        // Draw random flat lines initially
        const drawFlat = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(232, 220, 198, 0.2)'; // Cream
            ctx.lineWidth = 2;
            ctx.moveTo(0, canvas.height / 2);
            ctx.lineTo(canvas.width, canvas.height / 2);
            ctx.stroke();
        };
        drawFlat();

        // Animate on hover
        card.addEventListener('mouseenter', () => {
            canvas.style.opacity = '1';
            
            const animate = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.beginPath();
                ctx.strokeStyle = '#C8FF00'; // Lime accent
                ctx.lineWidth = 2;
                
                for (let x = 0; x < canvas.width; x += 2) {
                    const y = (canvas.height / 2) + 
                              Math.sin(x * 0.1 + time) * 10 * Math.sin(time * 2);
                    if (x === 0) ctx.moveTo(x, y);
                    else ctx.lineTo(x, y);
                }
                ctx.stroke();
                time += 0.2;
                animationId = requestAnimationFrame(animate);
            };
            animate();
        });

        card.addEventListener('mouseleave', () => {
            canvas.style.opacity = '0';
            cancelAnimationFrame(animationId);
            drawFlat();
            time = 0;
        });
    });
});