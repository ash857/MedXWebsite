let droneIsFlying = false;

function launchDrone() {
  if (droneIsFlying) return;
  droneIsFlying = true;

  const wrapper = document.createElement('div');
  wrapper.className = 'drone-wrapper';

  const scrollY = window.scrollY;
  const viewportHeight = window.innerHeight;
  const offset = Math.random() * 0.6 + 0.2; 
  wrapper.style.top = `${scrollY + offset * viewportHeight}px`;

  const drone = document.createElement('img');
  let droneSelect = Math.floor(Math.random() * 3) + 1;
  if (droneSelect === 1) {
    drone.src = 'images/flying-drone-3.png';
  } else if (droneSelect === 2) {
    drone.src = 'images/flying-drone-2.png';
  } else if (droneSelect === 3) {
    drone.src = 'images/flying-drone-4.png';
  }
  drone.className = 'drone';

  let isDragging = false;
  let isThrown = false;
  let offsetX = 0;
  let offsetY = 0;
  let velocityX = 0;
  let velocityY = 0;
  let gravity = 0.2;

  let dronePosX = 0;
  let dronePosY = 0;

  let prevMouseX = 0;
  let prevMouseY = 0;
  let prevMouseTime = 0;

  let lastMouseX = 0;
  let lastMouseY = 0;
  let lastMouseTime = 0;

  wrapper.appendChild(drone);
  document.body.appendChild(wrapper);
  dronePosX = wrapper.offsetLeft;
  dronePosY = wrapper.offsetTop;

  function updatePhysics() {
    if (isThrown) {
      velocityY += gravity;
      dronePosX += velocityX;
      dronePosY += velocityY;

      wrapper.style.left = `${dronePosX}px`;
      wrapper.style.top = `${dronePosY}px`;
      const droneWidth = wrapper.offsetWidth;
      const droneHeight = wrapper.offsetHeight;

      if (dronePosX < 0) {
        dronePosX = 0;
        velocityX = -velocityX * 0.7; // Bounce back with 70% energy
      }

      if (dronePosX + droneWidth > window.innerWidth) {
        dronePosX = window.innerWidth - droneWidth;
        velocityX = -velocityX * 0.7;
      }

      if (dronePosY > window.innerHeight + 1300) {
        wrapper.remove();
        droneIsFlying = false;
        launchNextDrone();
        return;
      }
    }
    requestAnimationFrame(updatePhysics);
  }

  updatePhysics();

  // --- Attach listeners ---
  drone.addEventListener('mousedown', event => {
    isDragging = true;
    isThrown = false;

    

    velocityX = 0;
    velocityY = 0;

    offsetX = event.clientX - wrapper.offsetLeft;
    offsetY = event.clientY - wrapper.offsetTop;
    
    wrapper.style.left = `${event.clientX - offsetX}px`;
    wrapper.style.top = `${event.clientY - offsetY}px`;

    wrapper.style.animationPlayState = 'paused';
    drone.style.animationPlayState = 'paused';
    drone.classList.add('drag');
    e.preventDefault();
    wrapper.style.zIndex = 1000;

    lastMouseX = e.clientX;
    lastMouseY = e.clientY;
    lastMouseTime = Date.now();
  });

  document.addEventListener('mousemove', e => {
    if (!isDragging) return;

    const x = e.clientX - offsetX;
    const y = e.clientY - offsetY;
    wrapper.style.left = `${x}px`;
    wrapper.style.top = `${y}px`;

    dronePosX = x;
    dronePosY = y;

    prevMouseX = lastMouseX;
    prevMouseY = lastMouseY;
    prevMouseTime = lastMouseTime;

    // Save most recent position/time only
    lastMouseX = e.clientX;
    lastMouseY = e.clientY;
    lastMouseTime = Date.now();
    wrapper.style.zIndex = 1000;
  });

  document.addEventListener('mouseup', () => {
    if (isDragging) {
      isDragging = false;

      const dx = lastMouseX - prevMouseX;
      const dy = lastMouseY - prevMouseY;
      const dt = (lastMouseTime - prevMouseTime) / 1000;

      if (dt > 0 && dt < 0.1) {
        velocityX = dx / dt * 0.005;
        velocityY = dy / dt * 0.005;

        // Cap max speed
        const maxVelocity = 20;
        velocityX = Math.max(Math.min(velocityX, maxVelocity), -maxVelocity);
        velocityY = Math.max(Math.min(velocityY, maxVelocity), -maxVelocity);
      }

      isThrown = true;
      drone.classList.remove('drag');
      drone.classList.add('fall');
      drone.style.cursor = 'grab';
    }
  });

  // When drone finishes falling
  drone.addEventListener('animationend', () => {
    wrapper.remove();
    droneIsFlying = false;
    launchNextDrone();
  }, { once: true });

  // If animation ends without interaction
  wrapper.addEventListener('animationend', () => {
    if (!drone.classList.contains('fall')) {
      wrapper.remove();
      droneIsFlying = false;
      launchNextDrone();
    }
  });

  
}

function launchNextDrone() {
  const delay = Math.random() * 1;
  setTimeout(launchDrone, delay);
}



launchNextDrone();
