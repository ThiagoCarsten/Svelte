<script>
  import { createEventDispatcher } from "svelte";
  export let quizzes = [];
  const dispatch = createEventDispatcher();

  function open(q) {
    dispatch("select", q);
  }
</script>

<div>
  <h3 class="small">Quizzes</h3>
  {#if quizzes.length === 0}
    <div class="small">Nenhum quiz disponível.</div>
  {:else}
    {#each quizzes as q}
      <button class="quiz-card" on:click={() => open(q)} type="button">
        <div
          style="display:flex; justify-content:space-between; align-items:center;"
        >
          <div>
            <div style="font-weight:700">{q.title}</div>
            <div class="small">{q.description}</div>
          </div>
          <div class="small">{q.questions.length} perguntas</div>
        </div>
      </button>
    {/each}
  {/if}
</div>
