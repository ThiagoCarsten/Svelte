export async function loadQuizzes() {
    // carrega o JSON local
    const res = await fetch('/src/data/quizzes.json');
    if (!res.ok) throw new Error('Não foi possível carregar quizzes');
    return await res.json();
  }
  
  const RESULTS_KEY = 'svelte_quiz_results_v1';
  
  export function saveResult(quizId, result) {
    const all = JSON.parse(localStorage.getItem(RESULTS_KEY) || '{}');
    all[quizId] = {
      ...all[quizId],
      ...result,
      date: new Date().toISOString()
    };
    localStorage.setItem(RESULTS_KEY, JSON.stringify(all));
  }
  
  export function getResult(quizId) {
    const all = JSON.parse(localStorage.getItem(RESULTS_KEY) || '{}');
    return all[quizId] ?? null;
  }
  