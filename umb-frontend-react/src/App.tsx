import { useState, useEffect } from "react";
import "./styles.css";
p
export default function App() {
  const [titulo, setTitulo] = useState("");   // Para escribir una tarea
  const [tareas, setTareas] = useState([]);   // Para guardar las tareas

  // 1️⃣ Cargar tareas desde la API
  useEffect(() => {
    fetch("TU_URL_API_AQUÍ") // Luego la cambiamos por Render
      .then((res) => res.json())
      .then((data) => setTareas(data));
  }, []);

  // 2️⃣ Enviar tarea a la API
  const agregarTarea = (e) => {
    e.preventDefault();

    fetch("TU_URL_API_AQUÍ", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ titulo })
    })
      .then((res) => res.json())
      .then(() => {
        // Actualizamos la lista localmente
        setTareas([...tareas, { titulo }]);
        setTitulo("");
      });
  };

  return (
    <div className="App">
      <h1>Gestión de Tareas</h1>

      {/* Formulario */}
      <form onSubmit={agregarTarea}>
        <input
          type="text"
          placeholder="Escribe una tarea"
          value={titulo}
          onChange={(e) => setTitulo(e.target.value)}
        />
        <button type="submit">Agregar</button>
      </form>

      {/* Lista de tareas */}
      <ul>
        {tareas.map((tarea, index) => (
          <li key={index}>{tarea.titulo}</li>
        ))}
      </ul>
    </div>
  );
}
