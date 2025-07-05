<div class="flex w-full h-2">
    <div class="w-1/5 bg-green-500"></div>
    <div class="w-1/5 bg-yellow-400"></div>
    <div class="w-1/5 bg-blue-500"></div>
    <div class="w-1/5 bg-gray-900"></div>
    <div class="w-1/5 bg-gray-400"></div>
</div>


<footer class=" dark:bg-gray-800 py-3 print:hidden sm:flex hidden ">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid mt-10 grid-cols-4 gap-4 text-sm">

            <!-- Coluna 1 -->
            <div>
                <h3 class="font-semibold mb-4">Estados</h3>
                <div class="flex flex-wrap pr-4">
                    @foreach (['SP','MG','ES','PR','CE','SP','MG','ES','PR','CE','SP','MG','ES','PR','CE','SP','MG','ES','PR','CE',] as $uf)
                    <a href="#" 
                    class="ml-4 font-bold text-blue-500 hover:text-yellow-700">{{ $uf }}</a> 
                    @endforeach
                </div>
            </div>

            <!-- Coluna 2 -->
            <div>
                <h3 class="font-semibold mb-4">Principais Cidades</h3>
                <ul class="space-y-2">


                    <li><a href="#" class="hover:underline">São Paulo</a></li>
                    <li><a href="#" class="hover:underline">Itaboraí</a></li>
                    <li><a href="#" class="hover:underline">Rio de Janeiro</a></li>
                    <li><a href="#" class="hover:underline">Ribeirão Preto</a></li>
                    <li><a href="#" class="hover:underline">Luziânia</a></li>
                    <li><a href="#" class="hover:underline">Taquaritinga do Norte</a></li>
                    <li><a href="#" class="hover:underline">Porto Alegre</a></li>
                    <li><a href="#" class="hover:underline">Santo Antônio do Descoberto</a></li>
                    <li><a href="#" class="hover:underline">Goiânia</a></li>
                </ul>
            </div>

            <!-- Coluna 3 -->
            <div>
                <h3 class="font-semibold mb-4">Principais Bairros</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                    <li><a href="#" class="hover:underline">Bairro Xyz</a></li>
                </ul>
            </div>

            <!-- Coluna 4 -->
            <div>
                <h3 class="font-semibold mb-4">Tipos</h3>


                @foreach (['apto','casa','terreno','rural','apto','casa','terreno','rural',] as $tipo)
                @php
                $cor = 'red'; // exemplo: bg-green-500
                $textColor = 'red'; // text-green-500
                @endphp
                <span
                    class="mt-2 ml-2 inline-flex items-center px-2 py-1 rounded font-medium bg-{{ $cor }}-300 text-{{ $textColor }}-800">
                    {{ ucfirst($tipo) }}
                </span>
                @endforeach


            </div>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 gap-4 text-sm">

            <!-- Coluna 1 -->
            <div>
                <h3 class="font-semibold mb-4">Sobre Nós</h3>
                <p class="mb-2">Somos uma promissora startup que pretende mapear todos os leiloes do Brasil.</p>
                <p>Atuamos com tecnologia de ponta, aproveitando todas as oportunidades que a Inteligencia Artificial
                    (IA) oferece.</p>
            </div>

            <!-- Coluna 2 -->
            <div>
                <h3 class="font-semibold mb-4">Master Class</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Como funciona Leilao ?</a></li>
                    <li><a href="#" class="hover:underline">Idoneidade de um Leiloeiro</a></li>
                    <li><a href="#" class="hover:underline">Como Avaliar uma Oportunidade</a></li>
                    <li><a href="#" class="hover:underline">Informacoes geradas pela IA</a></li>
                    <li><a href="#" class="hover:underline">Consultoria</a></li>
                </ul>
            </div>

            <!-- Coluna 3 -->
            <div>
                <h3 class="font-semibold mb-4">Links úteis</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Responsabilidade sobre informacoes</a></li>
                    <li><a href="#" class="hover:underline">Política de Privacidade</a></li>
                    <li><a href="#" class="hover:underline">Termos de Uso</a></li>
                </ul>
            </div>

            <!-- Coluna 4 -->
            <div>
                <h3 class="font-semibold mb-4">Empresa</h3>
                <p class="mb-2">CNPJ: em breve</p>
                <p class="mb-2">CREA-SP: em breve</p>
                <p class="mb-2">OAB/RJ: em breve</p>
                <p class="mb-2">CRECI/SP: em breve</p>
                <p class="mb-2">CRECI/RJ: em breve</p>
                <p class="mb-2">+55(11)XXXXX-XXXX</p>
                <p class="mb-2">garimpia@gmail.com</p>
            </div>

        </div>
<div class="grid grid-cols-2 gap-4 mt-8 gap-4 text-sm">

        <div class="flex items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <x-application-logo class="block h-9 w-auto" />
            </a>
        </div>

<div>
    
  <div class="flex items-center gap-4 mt-4">
                <a href="https://facebook.com" target="_blank" class="hover:text-blue-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.676 0H1.327C.594 0 0 .593 0 1.326v21.348C0 23.406.593 24 1.327 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.797.143v3.24l-1.918.001c-1.504 0-1.796.716-1.796 1.765v2.316h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.406 24 22.674V1.327C24 .593 23.407 0 22.676 0z"/></svg>
                </a>
                <a href="https://twitter.com" target="_blank" class="hover:text-blue-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.39-1.83.654-2.825.775a4.932 4.932 0 002.163-2.723 9.869 9.869 0 01-3.127 1.195 4.917 4.917 0 00-8.384 4.482C7.69 8.095 4.066 6.13 1.64 3.161a4.822 4.822 0 00-.666 2.475 4.92 4.92 0 002.188 4.1A4.902 4.902 0 01.964 9.15v.061a4.924 4.924 0 003.946 4.827 4.996 4.996 0 01-2.212.084 4.936 4.936 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.396 0-.79-.023-1.175-.069a13.945 13.945 0 007.548 2.212c9.057 0 14.009-7.496 14.009-13.986 0-.21 0-.423-.015-.634A10.012 10.012 0 0024 4.59z"/></svg>
                </a>
                <a href="https://instagram.com" target="_blank" class="hover:text-pink-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.337 3.608 1.311.975.975 1.25 2.242 1.311 3.608.058 1.266.069 1.646.069 4.849s-.012 3.584-.07 4.849c-.061 1.366-.336 2.633-1.311 3.608-.975.975-2.242 1.25-3.608 1.311-1.266.058-1.646.069-4.85.069s-3.584-.012-4.849-.07c-1.366-.061-2.633-.336-3.608-1.311-.975-.975-1.25-2.242-1.311-3.608C2.175 15.647 2.163 15.267 2.163 12s.012-3.584.07-4.849c.061-1.366.336-2.633 1.311-3.608C4.519 2.5 5.786 2.226 7.152 2.164 8.418 2.106 8.798 2.095 12 2.095m0-2.163C8.74 0 8.332.013 7.052.07 5.769.127 4.6.36 3.635 1.326 2.669 2.291 2.436 3.46 2.379 4.743 2.322 6.023 2.31 6.43 2.31 12s.013 5.978.07 7.258c.057 1.283.29 2.452 1.255 3.417.965.965 2.134 1.198 3.417 1.255C8.332 23.987 8.74 24 12 24s3.668-.013 4.948-.07c1.283-.057 2.452-.29 3.417-1.255.965-.965 1.198-2.134 1.255-3.417.057-1.28.07-1.688.07-7.258s-.013-5.978-.07-7.258c-.057-1.283-.29-2.452-1.255-3.417C19.4.36 18.231.127 16.948.07 15.668.013 15.26 0 12 0z"/><path d="M12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998zM18.406 4.594a1.44 1.44 0 100 2.879 1.44 1.44 0 000-2.879z"/></svg>
                </a>
                <a href="https://youtube.com" target="_blank" class="hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a2.96 2.96 0 00-2.083-2.088C19.613 3.5 12 3.5 12 3.5s-7.613 0-9.415.598A2.96 2.96 0 00.502 6.186 30.43 30.43 0 000 12a30.43 30.43 0 00.502 5.814 2.96 2.96 0 002.083 2.088C4.387 20.5 12 20.5 12 20.5s7.613 0 9.415-.598a2.96 2.96 0 002.083-2.088A30.43 30.43 0 0024 12a30.43 30.43 0 00-.502-5.814zM9.75 15.5v-7l6 3.5-6 3.5z"/></svg>
                </a>
            </div>

</div>

    </div>

        <div class="mt-5 border-t border-gray-700 py-4 text-white flex items-center justify-between px-4 flex-wrap">
            <!-- Redes sociais -->
          
        
            <!-- Rodapé central -->
            <div class="text-center text-sm text-gray-400 mt-2">
                ©2025 garimpIA.com - Todos os direitos reservados.
            </div>

            <!-- LGA à direita -->
            <div class="text-sm font-semibold text-white hover:text-gray-300 transition">


                    <div class="flex justify-center items-center gap-2">
                        <span class="font-semibold">Ingredientes:</span> 
                        <span class="bg-green-500 text-white px-2 py-0.5 rounded">PHP</span>
                        <span class="bg-yellow-500 text-gray-800 px-2 py-0.5 rounded">Laravel</span>
                        <span class="bg-blue-600 text-white px-2 py-0.5 rounded">🐧 Linux</span>
                    </div>
                    <span class="mt-1 text-xs italic">Cozinhado com </span>❤️<span class="mt-1 text-xs italic"> e I.A. por 
                        <a class="text-sky-300 no-underline hover:underline" href="https://www.linkedin.com/in/gustavoalmeidapro/" target="_blank">LGA</a>
                    </span>

            </div>





        </div>
        
       

    </div>
</footer>

<!-- Mobile view footer -->

<footer class=" dark:bg-gray-800 py-3 sm:hidden print:hidden">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid mt-10 grid-cols-2 gap-4 text-sm">

            <!-- Coluna 1 -->

            <div>
                <h3 class="font-semibold mb-4">Estados</h3>
                <div class="flex flex-wrap gap-4 pr-4">
                   @foreach (['SP','MG','ES','PR','CE','SP','MG','ES','PR','CE','SP','MG','ES','PR','CE','SP','MG','ES','PR','CE',] as $uf)
                        <a href="#" class="font-bold text-blue-500 hover:text-yellow-700">{{ $uf }}</a> 
                    @endforeach
                </div>
            </div>


            <!-- Coluna 2 -->
            <div>
                <h3 class="font-semibold mb-4">Principais Cidades</h3>
                <ul class="space-y-2">


                    <li><a href="#" class="hover:underline">São Paulo</a></li>
                    <li><a href="#" class="hover:underline">Itaboraí</a></li>
                    <li><a href="#" class="hover:underline">Rio de Janeiro</a></li>
                    <li><a href="#" class="hover:underline">Ribeirão Preto</a></li>
                    <li><a href="#" class="hover:underline">Luziânia</a></li>
                    <li><a href="#" class="hover:underline">Taquaritinga do Norte</a></li>
                    <li><a href="#" class="hover:underline">Porto Alegre</a></li>
                    <li><a href="#" class="hover:underline">Santo Antônio do Descoberto</a></li>
                    <li><a href="#" class="hover:underline">Goiânia</a></li>
                </ul>
            </div>

        </div>

        <div class="grid grid-cols-2 mt-8 gap-4 text-sm">

            <!-- Coluna 1 -->
            <div>
                <h3 class="font-semibold mb-4">Sobre Nós</h3>
                <p class="mb-2">Somos uma promissora startup que pretende mapear todos os leiloes do Brasil.</p>
                <p>Atuamos com tecnologia de ponta, aproveitando todas as oportunidades que a Inteligencia Artificial
                    (IA) oferece.</p>
            </div>

            <!-- Coluna 2 -->
            <div>
                <h3 class="font-semibold mb-4">Master Class</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Como funciona Leilao ?</a></li>
                    <li><a href="#" class="hover:underline">Idoneidade de um Leiloeiro</a></li>
                    <li><a href="#" class="hover:underline">Como Avaliar uma Oportunidade</a></li>
                    <li><a href="#" class="hover:underline">Informacoes geradas pela IA</a></li>
                    <li><a href="#" class="hover:underline">Consultoria</a></li>
                </ul>
            </div>

        </div>


        <div class="flex items-center mt-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <x-application-logo class="block h-9 w-auto" />
            </a>
             <!-- Redes sociais -->
            <div class="flex items-center gap-4 ml-auto">
                <a href="https://facebook.com" target="_blank" class="hover:text-blue-400 text-gray dark:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.676 0H1.327C.594 0 0 .593 0 1.326v21.348C0 23.406.593 24 1.327 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.797.143v3.24l-1.918.001c-1.504 0-1.796.716-1.796 1.765v2.316h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.406 24 22.674V1.327C24 .593 23.407 0 22.676 0z"/></svg>
                </a>
                <a href="https://twitter.com" target="_blank" class="hover:text-blue-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.39-1.83.654-2.825.775a4.932 4.932 0 002.163-2.723 9.869 9.869 0 01-3.127 1.195 4.917 4.917 0 00-8.384 4.482C7.69 8.095 4.066 6.13 1.64 3.161a4.822 4.822 0 00-.666 2.475 4.92 4.92 0 002.188 4.1A4.902 4.902 0 01.964 9.15v.061a4.924 4.924 0 003.946 4.827 4.996 4.996 0 01-2.212.084 4.936 4.936 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.396 0-.79-.023-1.175-.069a13.945 13.945 0 007.548 2.212c9.057 0 14.009-7.496 14.009-13.986 0-.21 0-.423-.015-.634A10.012 10.012 0 0024 4.59z"/></svg>
                </a>
                <a href="https://instagram.com" target="_blank" class="hover:text-pink-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.337 3.608 1.311.975.975 1.25 2.242 1.311 3.608.058 1.266.069 1.646.069 4.849s-.012 3.584-.07 4.849c-.061 1.366-.336 2.633-1.311 3.608-.975.975-2.242 1.25-3.608 1.311-1.266.058-1.646.069-4.85.069s-3.584-.012-4.849-.07c-1.366-.061-2.633-.336-3.608-1.311-.975-.975-1.25-2.242-1.311-3.608C2.175 15.647 2.163 15.267 2.163 12s.012-3.584.07-4.849c.061-1.366.336-2.633 1.311-3.608C4.519 2.5 5.786 2.226 7.152 2.164 8.418 2.106 8.798 2.095 12 2.095m0-2.163C8.74 0 8.332.013 7.052.07 5.769.127 4.6.36 3.635 1.326 2.669 2.291 2.436 3.46 2.379 4.743 2.322 6.023 2.31 6.43 2.31 12s.013 5.978.07 7.258c.057 1.283.29 2.452 1.255 3.417.965.965 2.134 1.198 3.417 1.255C8.332 23.987 8.74 24 12 24s3.668-.013 4.948-.07c1.283-.057 2.452-.29 3.417-1.255.965-.965 1.198-2.134 1.255-3.417.057-1.28.07-1.688.07-7.258s-.013-5.978-.07-7.258c-.057-1.283-.29-2.452-1.255-3.417C19.4.36 18.231.127 16.948.07 15.668.013 15.26 0 12 0z"/><path d="M12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998zM18.406 4.594a1.44 1.44 0 100 2.879 1.44 1.44 0 000-2.879z"/></svg>
                </a>
                <a href="https://youtube.com" target="_blank" class="hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a2.96 2.96 0 00-2.083-2.088C19.613 3.5 12 3.5 12 3.5s-7.613 0-9.415.598A2.96 2.96 0 00.502 6.186 30.43 30.43 0 000 12a30.43 30.43 0 00.502 5.814 2.96 2.96 0 002.083 2.088C4.387 20.5 12 20.5 12 20.5s7.613 0 9.415-.598a2.96 2.96 0 002.083-2.088A30.43 30.43 0 0024 12a30.43 30.43 0 00-.502-5.814zM9.75 15.5v-7l6 3.5-6 3.5z"/></svg>
                </a>
            </div>
        </div>

        <div class="mt-5 border-t border-gray-700 py-4 text-white flex items-center justify-between px-4 flex-wrap">
           
        
            <!-- Rodapé central -->
            <div class="text-center text-sm text-gray-400 mt-2">
                ©2025 garimpIA.com - Todos os direitos reservados.
            </div>

            <!-- LGA à direita -->
            <div class="text-sm font-semibold text-white hover:text-gray-300 transition">


                    <div class="flex justify-center items-center gap-2">
                        <span class="font-semibold">Ingredientes:</span> 
                        <span class="bg-green-500 text-white px-2 py-0.5 rounded">PHP</span>
                        <span class="bg-yellow-500 text-gray-800 px-2 py-0.5 rounded">Laravel</span>
                        <span class="bg-blue-600 text-white px-2 py-0.5 rounded">🐧 Linux</span>
                    </div>
                    <span class="mt-1 text-xs italic">Cozinhado com </span>❤️<span class="mt-1 text-xs italic"> e I.A. por 
                        <a class="text-sky-300 no-underline hover:underline" href="https://www.linkedin.com/in/gustavoalmeidapro/" target="_blank">LGA</a>
                    </span>

            </div>
        </div>
        
       

    </div>
</footer>