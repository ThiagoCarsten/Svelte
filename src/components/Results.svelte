<script>
    export let result;
    export let quiz;
  </script>
  
  <div>
    <h3>Resultado — {result.score}%</h3>
    <div class="small">{result.correct}/{result.total} corretas</div>
  
    <div style="margin-top:12px;">
      {#each quiz.questions as q}
        <div style="margin-bottom:10px; padding:8px; border-radius:8px; background: rgba(255,255,255,0.01)">
          <div style="font-weight:700">{q.text}</div>
          <div class="small">Sua resposta:
            {#if result.answers[q.id]}
              {#each q.options as o}
                {#if o.id === result.answers[q.id]}
                  <span>{o.text} {o.correct ? '✅' : '❌'}</span>
                {/if}
              {/each}
            {:else}
              <em>Não respondeu</em>
            {/if}
          </div>
          <div class="small">Resposta correta:
            {#each q.options as o}
              {#if o.correct}
                <span>{o.text}</span>
              {/if}
            {/each}
          </div>
        </div>
      {/each}
    </div>
  </div>
  