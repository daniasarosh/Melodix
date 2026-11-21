document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    /* ==========================================
       1. CINEMATIC AMBIENT CANVAS (3D & Parallax)
       ========================================== */
    const canvas = document.getElementById('ambient-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width, height;
        let mouseX = 0, mouseY = 0;
        let targetMouseX = 0, targetMouseY = 0;
        
        const resize = () => {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        };
        window.addEventListener('resize', resize);
        resize();

        // Track mouse for parallax
        window.addEventListener('mousemove', (e) => {
            targetMouseX = (e.clientX - width / 2) * 0.05;
            targetMouseY = (e.clientY - height / 2) * 0.05;
        });

        // Deep Glowing Particles
        const particles = [];
        for (let i = 0; i < 60; i++) {
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                radius: Math.random() * 2 + 1,
                baseX: Math.random() * width,
                baseY: Math.random() * height,
                speed: Math.random() * 0.5 + 0.1,
                angle: Math.random() * Math.PI * 2
            });
        }

        let time = 0;

        const draw = () => {
            // Clear with a trail effect for smooth motion blur
            ctx.fillStyle = 'rgba(18, 8, 10, 0.2)'; 
            ctx.fillRect(0, 0, width, height);

            // Smooth mouse parallax
            mouseX += (targetMouseX - mouseX) * 0.05;
            mouseY += (targetMouseY - mouseY) * 0.05;

            // 1. Draw 3D Audio-Wave Floor
            const horizon = height * 0.75;
            ctx.lineWidth = 1.5;
            
            for (let z = 0; z < 20; z++) {
                const zOffset = z * 40;
                const yPos = horizon + zOffset + (Math.sin(time * 0.5 + z) * 10);
                
                ctx.beginPath();
                ctx.strokeStyle = `rgba(155, 68, 82, ${0.4 - (z * 0.02)})`; // Burgundy Light
                
                for (let x = -50; x < width + 50; x += 20) {
                    // Create wave effect based on time and x position
                    const wave = Math.sin(x * 0.01 + time + z * 0.2) * (30 + z * 2);
                    if (x === -50) ctx.moveTo(x + mouseX, yPos + wave + mouseY);
                    else ctx.lineTo(x + mouseX, yPos + wave + mouseY);
                }
                ctx.stroke();
            }

            // 2. Draw Rotating 3D Wireframe Torus (Left Side)
            ctx.save();
            ctx.translate(width * 0.15 + mouseX * 1.5, height * 0.3 + mouseY * 1.5);
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(114, 47, 55, 0.3)'; // Burgundy
            const torusRadius = 80;
            for (let i = 0; i < 10; i++) {
                const rot = time * 0.5 + (i * Math.PI / 5);
                ctx.ellipse(0, 0, torusRadius, torusRadius * 0.3, rot, 0, Math.PI * 2);
            }
            ctx.stroke();
            ctx.restore();

            // 3. Draw Rotating 3D Wireframe Sphere (Right Side)
            ctx.save();
            ctx.translate(width * 0.85 + mouseX * -2, height * 0.6 + mouseY * -2);
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(200, 255, 0, 0.15)'; // Subtle Lime
            const sphereRadius = 100;
            for (let i = 0; i < 5; i++) {
                const rot = time * -0.3 + (i * Math.PI / 5);
                ctx.ellipse(0, 0, sphereRadius, sphereRadius * 0.4, rot, 0, Math.PI * 2);
            }
            ctx.stroke();
            ctx.restore();

            // 4. Draw Floating Particles
            particles.forEach(p => {
                p.angle += p.speed * 0.02;
                p.x = p.baseX + Math.cos(p.angle) * 20 + mouseX * 0.5;
                p.y = p.baseY + Math.sin(p.angle) * 20 + mouseY * 0.5;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(200, 255, 0, ${Math.random() * 0.3 + 0.1})`; // Lime glow
                ctx.fill();
            });

            time += 0.02;
            requestAnimationFrame(draw);
        };
        draw();
    }

    /* ==========================================
       2. 3D TILT SCROLL REVEAL
       ========================================== */
    const revealElements = document.querySelectorAll('[data-reveal], [data-reveal-stagger]');
    if (revealElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    if (entry.target.hasAttribute('data-reveal-stagger')) {
                        const children = entry.target.children;
                        Array.from(children).forEach((child, index) => {
                            // Dramatic 3D stagger entrance
                            child.style.transitionDelay = `${index * 0.08}s`;
                            child.classList.add('reveal-3d-item');
                        });
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        revealElements.forEach(el => observer.observe(el));
    }
});