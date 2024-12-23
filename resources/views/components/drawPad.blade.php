<section>
    <div class="h-[9vh] z-30 bg-gray-600 text-gray-100 items-center flex top-0 md:justify-evenly gap-2 md:gap-10 fixed right-0 left-0">
        <div class="md:inline">
            <img class="h-[8vh]" src="{{asset('assets/img/logo.png')}}" alt="">
        </div>
        <div class="items-center flex md:justify-center gap-2 md:gap-10 text-sm md:text-lg">
            <input class="md:h-12 bg border-2 bg-gray-500 shadow-md hover:shadow-lg transition duration-300 ease-in-out" type="color" id="colorPicker" value="#ffffff" title="Choose a color">
            <button id="resetButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold md:py-1 md:px-2 rounded inline-flex items-center">
                <img class="w-2 md:w-5 h-2 md:h-5" src="{{asset('assets/img/reset.svg')}}" alt="">
                <span>Reset</span>
            </button>
            <button id="eraseButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold md:py-1 md:px-2 rounded inline-flex items-center">
                <img class="w-2 md:w-5 h-2 md:h-5" src="{{asset('assets/img/erase.svg')}}" alt="">
                <span>Erase</span>
            </button>
            <a href="#answer">
                <button onclick="getAnswer()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold md:py-1 md:px-2 rounded inline-flex items-center">
                    <img class="w-2 md:w-4 h-2 md:h-4 mr-1" src="{{asset('assets/img/answer.svg')}}" alt="">
                    <span>Get Answer</span>
                </button>
            </a>
        </div>
    </div>

    <div class="md:flex grid gap-2 justify-evenly items-center mt-[10vh]">
        <div class="bg-gray-700 rounded-md shadow shadow-neutral-300">
            <canvas class="cursor-cell" id="drawingCanvas" width="700" height="550"></canvas>
        </div>

        <div class="w-[100vw] h-[100vh] md:w-[40vw] md:h-[550px] rounded-md bg-gray-600 shadow shadow-neutral-300">
            <div class="mb-1">
                <div id="answer" class="w-[100vw] h-[90vh] md:w-[40vw] md:h-[510px] text-white p-5 overflow-auto">Answer Show Here....</div>
            </div>
            <div class="md:w-full h-[40px] flex justify-center items-center gap-x-2 pb-4 px-3">
                <input type="text" class="w-full bg-gray-500 border-2 py-1 border-orange-400 text-white rounded-md" name="prompt" id="prompt" placeholder="Enter Your Extra Question">
                <button onclick="getAnswer()" class="px-4 py-2 text-sm font-bold hover:bg-green-500 bg-lime-400 rounded-md">Answer</button>
            </div>
        </div>
    </div>

    <!-- Loader -->
    <div id="loader" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <!-- AI Typing Dots Animation -->
        <div class="flex space-x-2">
            <div class="w-3 h-3 bg-red-400 rounded-full animate-bounce delay-0"></div>
            <div class="w-3 h-3 bg-yellow-400 rounded-full animate-bounce delay-200"></div>
            <div class="w-3 h-3 bg-lime-400 rounded-full animate-bounce delay-400"></div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('drawingCanvas');
        const ctx = canvas.getContext('2d');
        const colorPicker = document.getElementById('colorPicker');
        const resetButton = document.getElementById('resetButton');
        const eraseButton = document.getElementById('eraseButton');
        const answer = document.getElementById('answer');
        const loader = document.getElementById('loader');

        let drawing = false;
        let isErasing = false;
        let currentColor = '#fff';

        colorPicker.addEventListener('input', (e) => {
            currentColor = e.target.value;
            isErasing = false;
        });

        const getTouchPos = (e) => {
            const rect = canvas.getBoundingClientRect();
            const touch = e.touches[0];
            return {
                x: touch.clientX - rect.left,
                y: touch.clientY - rect.top
            };
        };

        const startDrawing = (e) => {
            drawing = true;
            ctx.beginPath();
            const pos = e.touches ? getTouchPos(e) : { x: e.offsetX, y: e.offsetY };
            ctx.moveTo(pos.x, pos.y);
            e.preventDefault();
        };

        const draw = (e) => {
            if (!drawing) return;
            const pos = e.touches ? getTouchPos(e) : { x: e.offsetX, y: e.offsetY };

            if (isErasing) {
                ctx.clearRect(pos.x - 5, pos.y - 5, 10, 10);
            } else {
                ctx.lineTo(pos.x, pos.y);
                ctx.strokeStyle = currentColor;
                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.stroke();
            }
            e.preventDefault();
        };

        const stopDrawing = (e) => {
            drawing = false;
            ctx.closePath();
            e.preventDefault();
        };

        resetButton.addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        eraseButton.addEventListener('click', () => {
            isErasing = true;
        });

        async function getAnswer() {
            const prompt = document.getElementById('prompt').value;
            const imageData = canvas.toDataURL('image/png');
            loader.classList.remove('hidden');

            try {
                const response = await axios.post('/api/post-data', { image: imageData, prompt: prompt });
                const htmlContent = marked.parse(response.data.info.text);
                answer.innerHTML = `<div>${htmlContent}</div>`;
                console.log(response.data.info.text);
            } catch (error) {
                console.error('Error uploading image:', error);
            } finally {
                loader.classList.add('hidden');
            }
        }

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);

        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('touchmove', draw);
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchcancel', stopDrawing);
    </script>
</section>
