<script>
    import { onMount } from "svelte";
  
    let quizzes = [];
    let current = 0;
    let selected = null;
    let score = 0;
    let finished = false;
    let carregando = true;
  
    onMount(() => {
      // Simula carregamento dos quizzes (como se viessem de artigos)
      quizzes = [
        {
          artigo: "O desmatamento da Amazônia aumenta as emissões de carbono e reduz a biodiversidade.",
          pergunta: "Qual é uma consequência direta do desmatamento citada no texto?",
          opcoes: [
            "Aumento da biodiversidade",
            "Redução das emissões de carbono",
            "Aumento das emissões de carbono",
            "Aumento das chuvas na Amazônia"
          ],
          resposta: 2
        },
        {
          artigo: "O uso de energia solar tem crescido, pois é uma alternativa limpa e renovável.",
          pergunta: "Por que a energia solar é considerada uma boa opção?",
          opcoes: [
            "Porque depende de combustíveis fósseis",
            "Porque é uma energia renovável e limpa",
            "Porque não precisa de investimento",
            "Porque gera poluição"
          ],
          resposta: 1
        },
        {
          artigo: "A reciclagem ajuda a reduzir o volume de lixo e economiza recursos naturais.",
          pergunta: "Segundo o texto, qual é um dos benefícios da reciclagem?",
          opcoes: [
            "Aumentar o consumo de plástico",
            "Reduzir o volume de lixo",
            "Aumentar o desperdício",
            "Usar mais recursos naturais"
          ],
          resposta: 1
        }
      ];
  
      // Marca que terminou de carregar
      carregando = false;
    });
  
    function responder() {
      if (selected === null) {
        alert("Escolhe uma opção antes de confirmar!");
        return;
      }
  
      if (selected === quizzes[current].resposta) score++;
  
      selected = null;
      if (current < quizzes.length - 1) {
        current++;
      } else {
        finished = true;
      }
    }
  
    function reiniciar() {
      current = 0;
      selected = null;
      score = 0;
      finished = false;
    }
  </script>
  


  <main class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
    {#if !finished}
      <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-xl text-center">
        <p class="text-sm text-gray-500 italic mb-2">
          {quizzes[current].artigo}
        </p>
        <h2 class="text-xl font-semibold mb-4">{quizzes[current].pergunta}</h2>
  
        <div class="space-y-2">
          {#each quizzes[current].opcoes as opcao, i}
            <button
              class="w-full border rounded-lg py-2 px-3 text-left transition
                     hover:bg-blue-100 {selected === i ? 'bg-blue-200' : ''}"
              on:click={() => (selected = i)}
            >
              {opcao}
            </button>
          {/each}
        </div>
  
        <button
        type="button"
        class="mt-5 bg-blue-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-blue-700"
        on:click={responder}
      >
        Confirmar
      </button>
      
      </div>
    {:else}
      <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md text-center">
        <h2 class="text-2xl font-bold mb-4">Resultado</h2>
        <p class="text-lg mb-6">
          Você acertou <b>{score}</b> de <b>{quizzes.length}</b> perguntas!
        </p>
        <button
          class="bg-green-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-green-700"
          on:click={reiniciar}
        >
          Jogar novamente
        </button>
      </div>
    {/if}
  </main>
  
  <style>
    main {
      font-family: system-ui, sans-serif;
    }
  </style>
  