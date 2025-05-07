<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionElements = document.querySelectorAll("#faq-questions > div");
        
        questionElements.forEach(questionElement => {
            questionElement.addEventListener("click", () => {
                // Find the question and answer elements
                const questionTitle = questionElement.querySelector("div:first-child");
                const answer = questionElement.querySelector("div:last-child");
                
                // Reset all questions to default color and border first
                questionElements.forEach(q => {
                    const qTitle = q.querySelector("div:first-child");
                    qTitle.classList.replace("text-[#005096]", "text-[#000257]");
                    
                    // Reset border styling
                    q.classList.remove("border-[#005096]");
                    q.classList.remove("border-2");
                    q.classList.add("border-gray-100");
                    q.classList.add("border");
                    
                    // Remove any active state shadow
                    q.classList.remove("shadow-md");
                    q.classList.add("shadow-sm");
                });
                
                // Toggle current answer
                if (answer.classList.contains("hidden")) {
                    // Close all other answers first
                    questionElements.forEach(q => {
                        q.querySelector("div:last-child").classList.add("hidden");
                    });
                    
                    // Change active question color
                    questionTitle.classList.replace("text-[#000257]", "text-[#005096]");
                    
                    // Add special border to active question
                    questionElement.classList.remove("border-gray-100");
                    questionElement.classList.remove("border");
                    questionElement.classList.add("border-[#005096]");
                    questionElement.classList.add("border-2");
                    
                    // Add shadow to active question
                    questionElement.classList.remove("shadow-sm");
                    questionElement.classList.add("shadow-md");
                    
                    // Show this answer with a smooth transition
                    answer.classList.remove("hidden");
                    answer.style.maxHeight = "0";
                    answer.style.opacity = "0";
                    
                    // Force browser to recognize the change before applying the animation
                    setTimeout(() => {
                        answer.style.transition = "max-height 0.5s ease, opacity 0.5s ease";
                        answer.style.maxHeight = "200px";
                        answer.style.opacity = "1";
                    }, 50);
                } else {
                    // Hide with animation
                    answer.style.maxHeight = "0";
                    answer.style.opacity = "0";
                    
                    // After animation finishes, hide completely
                    setTimeout(() => {
                        answer.classList.add("hidden");
                    }, 300);
                }
            });
        });
    });
    </script>