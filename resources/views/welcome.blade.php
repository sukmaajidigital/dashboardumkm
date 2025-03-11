<x-layouts>
    <x-slot name="header">
        Dashboard 3D Interaktif
    </x-slot>

    <div class="card-body">
        <!-- Container untuk canvas 3D -->
        <div class="w-full h-[500px] bg-gray-100 rounded-lg overflow-hidden">
            <div id="3d-container" class="w-full h-full"></div>
        </div>
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three/examples/js/loaders/GLTFLoader.js"></script>
        <script>
            // Setup scene, camera, dan renderer
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            const renderer = new THREE.WebGLRenderer({
                antialias: true
            });
            renderer.setSize(window.innerWidth, window.innerHeight);
            document.getElementById('3d-container').appendChild(renderer.domElement);

            // Posisikan kamera
            camera.position.z = 5;
            camera.position.y = 2;
            camera.lookAt(0, 0, 0);

            // Fungsi untuk mengonversi RGB ke hexadecimal
            function rgbToHex(r, g, b) {
                return (r << 16) | (g << 8) | b;
            }

            // Fungsi untuk memuat konfigurasi pencahayaan dari JSON
            async function loadLightingConfig() {
                const response = await fetch('set.json'); // Path ke file JSON
                const config = await response.json();

                // Tambahkan Environment Light (AmbientLight)
                const envColor = rgbToHex(config.Environment.Red, config.Environment.Green, config.Environment.Blue);
                const envIntensity = config.Environment.Intensity / 100; // Normalisasi intensitas
                const ambientLight = new THREE.AmbientLight(envColor, envIntensity);
                scene.add(ambientLight);

                // Tambahkan Directional Lights (Light0, Light1, Light2)
                const lights = [config.Light0, config.Light1, config.Light2];
                lights.forEach((lightConfig, index) => {
                    const lightColor = rgbToHex(lightConfig.Red, lightConfig.Green, lightConfig.Blue);
                    const lightIntensity = lightConfig.Intensity / 100; // Normalisasi intensitas
                    const directionalLight = new THREE.DirectionalLight(lightColor, lightIntensity);

                    // Atur posisi cahaya berdasarkan rotasi
                    const angle = (config.LightRotation * Math.PI) / 180; // Konversi ke radian
                    const radius = 5; // Jarak dari pusat scene
                    directionalLight.position.set(
                        Math.cos(angle + (index * 120 * Math.PI / 180)) * radius,
                        Math.sin(angle + (index * 120 * Math.PI / 180)) * radius,
                        5
                    );

                    scene.add(directionalLight);
                });
            }

            // Load model 3D
            const loader = new THREE.GLTFLoader();
            let model, mixer;

            loader.load(
                'Bee.glb', // Path ke file Bee.glb
                (gltf) => {
                    model = gltf.scene;
                    scene.add(model);

                    // Sesuaikan skala dan posisi model
                    model.scale.set(0.5, 0.5, 0.5);
                    model.position.set(0, 0, 0);

                    // Jika model memiliki animasi, putar animasi
                    if (gltf.animations && gltf.animations.length > 0) {
                        mixer = new THREE.AnimationMixer(model);
                        const action = mixer.clipAction(gltf.animations[0]);
                        action.play();
                    }
                },
                (xhr) => {
                    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                },
                (error) => {
                    console.error('Error loading model:', error);
                }
            );

            // Memuat konfigurasi pencahayaan
            loadLightingConfig();

            // Fungsi untuk animasi
            const clock = new THREE.Clock();

            function animate() {
                requestAnimationFrame(animate);

                // Update animasi model
                if (mixer) {
                    mixer.update(clock.getDelta());
                }

                renderer.render(scene, camera);
            }
            animate();

            // Handle resize window
            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        </script>
    @endpush
</x-layouts>
