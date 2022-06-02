import React, { useState, useContext } from "react";
import { Link } from "react-router-dom";
import Context from "Context/UserContext";
import "./index.css";
import { NavBarOptions } from "Components/NavBarOptions";

function Header() {
  const { jwt } = useContext(Context);

  return (
    <header className="header">
      <Link to="/">
        <img src="" alt="" className="logoPage" />
      </Link>
      {jwt ? <NavBarOptions /> : <span></span>}
    </header>
  );
}

export { Header };
