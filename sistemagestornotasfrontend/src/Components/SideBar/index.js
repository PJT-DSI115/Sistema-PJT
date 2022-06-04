import React, { useState, useContext } from "react";
import Context from "Context/UserContext";
import "./index.css";
import { NavBarOptions } from "Components/NavBarOptions";
import { useUser } from "Hooks/useUser";

function Sidebar() {
  const { jwt } = useContext(Context);
  //const { isLogged, logout, idRol } = useUser();
  const [openValue, setOpenValue] = useState(false);

  const handleClick = () => {
    setOpenValue(!openValue);
  };

  /*const handleLogout = () =>{
    logout();
  }*/

  return (
    <div
      className={openValue ? "Sidebar-container" : "Sidebar-container SBclose"}
    >
      {jwt ? (
        <div
          className={
            openValue ? "Sidebar-content" : "Sidebar-content SBcontent"
          }
          onClick={handleClick}
        >
          <div className={openValue ? "SBactive" : "Sidebar-btn"}>
            <div className="Sidebar-btn-l"></div>
          </div>
        </div>
      ) : (
        ""
      )}
      {jwt ? <div>{openValue ? <NavBarOptions /> : ""}</div> : ""}
      {jwt ? (
        <div className="Sidebar-user">
          {openValue ? (
            <div className="Sidebar-user-card"></div>
          ) : (
            <div className="Sidebar-logout"></div>
          )}
        </div>
      ) : (
        ""
      )}
    </div>
  );
}

export { Sidebar };
