document.addEventListener("DOMContentLoaded", function() {
    fetch("/projects")
        .then(response => {
            if (!response.ok) {
                throw new Error("Errore nel recupero dei dati");
            }
            return response.json();
        })
        .then(projects => {
            console.log(projects)
            const getColorClass = (performance) => {
                if (performance < 33) return "bg-red-500";
                if (performance >= 33 && performance <= 66) return "bg-yellow-500";
                return "bg-green-500";
            };

            const container = document.getElementById("projects-container");
            projects.forEach(proj => {
                const card = document.createElement("div");
                card.className = `rounded-lg shadow-md p-4 text-center cursor-pointer ${getColorClass(proj.performance)}`;
                card.onclick = () => window.location.href = `project?id=${proj.project_id}`;
                card.innerHTML = `
                    <img src="/public/static/${proj.image_path}" alt="${proj.project_name}" class="w-20 mx-auto rounded-md">
                    <div class="text-lg font-semibold mt-2 text-white">${proj.project_name}</div>
                    <div class="text-white font-medium">Performance: ${proj.performance}%</div>
                `;
                container.appendChild(card);
            });
        })
        .catch(error => console.error("Errore nel recupero dei progetti:", error));
});