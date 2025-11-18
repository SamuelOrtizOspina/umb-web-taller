import { useState, useEffect } from "react";
import "./styles.css";

export default function App() {
  const [titulo, setTitulo] = useState("");
  const [tareas, setTareas] = useState([]);

  // Cargar tareas
  useEffect(() => {
    fetch("https://umb-web-taller-nlmm.onrender.com/api/index.php")
      .then((res) => res.json())
      .then((data) => setTareas(data))
      .catch((err) => console.error("Error cargando tareas:", err));
  }, []);

  // Agregar tarea
  const agregarTarea = (e) => {
    e.preventDefault();

    fetch("https://umb-web-taller-nlmm.onrender.com/api/index.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ titulo }),
    })
      .then((res) => res.json())
      .then((nuevaTarea) => {
        setTareas([...tareas, nuevaTarea]);
        setTitulo("");
      })
      .catch((err) => console.error("Error agregando tarea:", err));
  };

  return (
    <div className="App">
      <h1>Gestión de Tareas</h1>

      <form onSubmit={agregarTarea}>
        <input
          type="text"
          placeholder="Escribe una tarea"
          value={titulo}
          onChange={(e) => setTitulo(e.target.value)}
        />
        <button type="submit">Agregar</button>
      </form>

      <ul>
        {tareas.map((t, i) => (
          <li key={i}>{t.titulo}</li>
        ))}
      </ul>
    </div>
  );
}
