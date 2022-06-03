import './index.css';
function AlertMessage({ title, descripction, onClose, onEvent, dataUpdate }) {
    return (
        <div className='Alert-message-container'>
            <h2 className = "Alert-message-title">{ title }</h2>
            <p className = "Alert-message-description">{ descripction }</p>
            
            <div className = "Alert-message-btns">
                <button 
                    onClick = { () => {
                            onEvent({ data: dataUpdate }) 
                            onClose()
                        }
                    }
                    className = "Alert-message-btn"
                >Aceptar</button>
                <button 
                    className = "Alert-message-btn Alert-message-btn-red"
                    onClick = { onClose }
                >
                    Cancelar
                </button>
            </div>

        </div>
    )
}

export {AlertMessage};
