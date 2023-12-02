const form = document.querySelector('#exercise-form');
const exerciseList = document.querySelector('#exercise-list');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const muscleGroup = document.querySelector('#muscle-group').value;
  showExercises(muscleGroup);
});

function showExercises(muscleGroup) {
  exerciseList.innerHTML = ''; // clear previous exercises
  let exercises = [];
  switch (muscleGroup) {
    case 'chest':
      exercises = [
        { name: 'Bench Press', videoUrl: 'https://www.youtube.com/watch?v=rT7DgCr-3pg' },
        { name: 'Incline Dumbbell Press', videoUrl: 'https://www.youtube.com/embed/z5IzuL_1JFg' },
        { name: 'Push-Up', videoUrl: 'https://www.youtube.com/embed/IODxDxX7oi4' }
      ];
      break;
    case 'back':
      exercises = [
        { name: 'Pull-Up', videoUrl: 'https://www.youtube.com/embed/eGo4IYlbE5g' },
        { name: 'Barbell Deadlift', videoUrl: 'https://www.youtube.com/embed/op9kVnSso6Q' },
        { name: 'Bent-Over Barbell Row', videoUrl: 'https://www.youtube.com/embed/6Z15_WdXmGw' }
      ];
      break;
    case 'legs':
      exercises = [
        { name: 'Squat', videoUrl: 'https://www.youtube.com/embed/nhoikoUEI8U' },
        { name: 'Leg Press', videoUrl: 'https://www.youtube.com/embed/JGwWNGJdvx8' },
        { name: 'Romanian Deadlift', videoUrl: 'https://www.youtube.com/embed/2JcQ2xLbEDM' }
      ];
      break;
    case 'arms':
      exercises = [
        { name: 'Bicep Curl', videoUrl: 'https://www.youtube.com/embed/1lA5zJ8-7NE' },
        { name: 'Tricep Extension', videoUrl: 'https://www.youtube.com/embed/1iODncOLips' },
        { name: 'Close-Grip Bench Press', videoUrl: 'https://www.youtube.com/embed/EBWPtSsWJWE' }
      ];
      break;
    default:
      return;
  }
  exercises.forEach((exercise) => {
    const exerciseDiv = document.createElement('div');
    exerciseDiv.classList.add('exercise');
    const heading = document.createElement('h3');
    heading.textContent = exercise.name;
    const video = document.createElement('iframe');
    video.src = exercise.videoUrl;
    exerciseDiv.appendChild(heading);
    exerciseDiv.appendChild(video);
    exerciseList.appendChild(exerciseDiv);
  });
}

