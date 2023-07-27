<!DOCTYPE html>
<html>
<head>
    <title>EZNANDZZ.AI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <link rel="icon" href="i.png" type="image/jpeg">
    @vite('resources/css/app.css')
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head> 
<body class="bg-slate-900 text-white">
<div>
<h1 class="flex justify-center font-bold bg-slate-700 w-full h-14 items-center text-2xl text-white hover:text-green-500  duration-200">ATENG.AI</h1>

    <div id="chat-box" class=" ml-10 mt-12">
        <!-- tempat isi nya-->
    </div>
    
    <form id="chat-form" class="flex justify-center items-center rounded-lg py-2 px-4 text-black">
        <!-- Menambahkan @csrf untuk menghasilkan hidden input berisi CSRF token -->
        @csrf
        <div class="mt-[200px]">
        <input class="rounded-lg " type="text" id="user-input" placeholder="Type your message..." >
        <button type="submit" class="h-10 px-6 rounded-md bg-gray-600 text-white hover:bg-green-500 duration-100"><img src="p.png" class=" h- w-3"></button>
    </form>
    </div>

    <footer class=" mt-[400px] footer items-center p-4 bg-gray-600 text-white">
    <div class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
    <a href="https://github.com/Skyzoosky"><img src="github.png" class=" h-10 w-10 hover:bg-green-500 rounded-full" alt=""></a>
    <a href="https://github.com/Sanjaee"><img src="github.png" class=" h-10 w-10 hover:bg-blue-500 rounded-full" alt=""></a>
     </div>
  <div class="items-center grid-flow-col">
    <p>Copyright EZNANDZZ © 2023 - All right reserved</p>
  </div> 
 
</footer>
    </div>

    



 <!--JavaScript nya-->
 <script>
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');

    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const message = userInput.value;
        userInput.value = '';

        // Menampilkan pesan loading sebelum panggilan API
        chatBox.innerHTML += '<p><strong>Loading...</strong></p>';

        // Menggunakan Fetch API untuk mengirim pesan ke backend (Laravel)
        fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Menghilangkan pesan loading dan menampilkan balasan dari bot
            chatBox.innerHTML = chatBox.innerHTML.replace('<p><strong>Loading...</strong></p>', '');
            chatBox.innerHTML += '<p><strong>User:</strong> ' + message + '</p>';
            chatBox.innerHTML += '<p><strong>AI:</strong> ' + data.reply + '</p>';
        })
        .catch(error => {
            // Menghilangkan pesan loading jika terjadi error
            chatBox.innerHTML = chatBox.innerHTML.replace('<p><strong>Loading...</strong></p>', '');
            console.error('Error:', error);
        });
    });
</script>

</body>
</html>
