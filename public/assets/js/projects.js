document.addEventListener('DOMContentLoaded', () => {
    const projectsContainer = document.getElementById('projects-container');

    const fetchProjects = async () => {
        try {
            const response = await fetch('/controllers/ProjectController.php');
            const projects = await response.json();
            projectsContainer.innerHTML = projects
                .map(project => `
                    <div class="project">
                        <h3>${project.name}</h3>
                        <p>${project.description}</p>
                    </div>
                `)
                .join('');
        } catch (error) {
            projectsContainer.innerHTML = `<p>Failed to load projects. Please try again later.</p>`;
        }
    };

    // Initial fetch
    fetchProjects();
});
