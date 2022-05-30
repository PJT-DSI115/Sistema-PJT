
function ListNivel({ nivel, handleChange }) {

    return (
      <select 
        className="Niveles-select"
        onChange={handleChange}
        >
          <option value="0"></option>
        {nivel.map((nl) => (
          <option key={nl.id} value={nl.id}>
            {nl.nombre_nivel}
          </option>
        ))}
      </select>

    );

}

export { ListNivel };
