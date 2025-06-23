for (let i = 1; i <= 100; i++) {
      const box = document.createElement('div');
      box.classList.add('box');
      box.textContent = `Box ${i}`;

      if (i % 2 === 0) {
        box.classList.add('even');
      } else {
        box.classList.add('odd');
      }

      document.body.appendChild(box);
    }