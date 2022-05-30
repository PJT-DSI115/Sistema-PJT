import './css/ListNivel.css';

function ListNivel({ nivel, handleChange }) {

    return (
      <select 
        className="Niveles-select"
        onChange={handleChange}
        >
          <option 
            value="0"
            className='select-option'></option>
        {nivel.map((nl) => (
          <option key={nl.id} value={nl.id} className='select-option'>
            {nl.nombre_nivel}
          </option>
        ))}
      </select>

    );

}

export { ListNivel };
