<script>
  import { onMount } from 'svelte';
  import { saveResult, getResult } from '../lib/storage.js';
  export let quiz;

  let currentIndex = 0;
  let answers = {};
  let startedAt = null;
  let finished = false;
  let savedResult = null;

  onMount(() => {
    savedResult = getResult(quiz.id);
    startedAt = new Date();
  });

  function selectOption(qid, optId) {
    answers[qid] = optId;
  }

  function next() {
    if (currentIndex < quiz.questions.length - 1) currentIndex += 1;
  }

  function prev() {
    if (currentIndex > 0) currentIndex -= 1;
  }

  function submit() {
    const total = quiz.questions.length;
    let correct = 0;
    quiz.questions.forEach(q => {
      const chosen = answers[q.id];
      const opt = q.options.find(o => o.id === chosen);
      if (opt && opt.correct) correct++;
    });
    const score = Math.round((correct / total) * 100);
    const result = { total, correct, score, answers };
    saveResult(quiz.id, result);
    savedResult = result;
    finished = true;
  }
</script>

<div>
  <div style="display:flex; justify-content:space-between; align-items:center;">
    <div>
      <h2>{quiz.title}</h2>
      <div class="small">{quiz.description}</div>
    </div>
    <div class="small">Perguntas: {quiz.questions.length}</div>
  </div>

  {#if savedResult && !finished}
    <div style="margin:8px 0; padding:10px; border-radius:8px; background:rgba(255,255,255,0.02)">
      Resultado salvo: <strong>{savedResult.score}%</strong> — {savedResult.correct}/{savedResult.total} corretas.
    </div>
  {/if}

  {#if finished}
    <slot name="results" {savedResult}></slot>
  {:else if quiz.questions.length > 0}
    <!-- Usa diretamente a pergunta atual -->
    {#key currentIndex}
      {#if quiz.questions[currentIndex]}
        <div class="question">{currentIndex + 1}. {quiz.questions[currentIndex].text}</div>
        <div class="answers">
          {#each quiz.questions[currentIndex].options as o}
            <button
              class="btn {answers[quiz.questions[currentIndex].id] === o.id ? 'selected' : ''}"
              on:click={() => selectOption(quiz.questions[currentIndex].id, o.id)}
            >
              <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>{o.text}</div>
                <div class="small">{o.id}</div>
              </div>
            </button>
          {/each}
        </div>

        <div class="footer-controls">
          <button class="ghost" on:click={prev} disabled={currentIndex===0}>Anterior</button>
          {#if currentIndex < quiz.questions.length - 1}
            <button class="ghost" on:click={next}>Próxima</button>
          {:else}
            <button class="primary" on:click={submit}>Finalizar</button>
          {/if}
        </div>
      {/if}
    {/key}
  {:else}
    <div>Nenhuma pergunta encontrada.</div>
  {/if}
</div>
