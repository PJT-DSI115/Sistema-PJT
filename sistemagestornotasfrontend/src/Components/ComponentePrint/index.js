import React from "react";
import { useRegistroNota } from "Hooks/useRegistroNota";
import { Loader } from "Components/Loader";
import { BoletaPDF } from "./ComponentePrint";

import { Document, Page } from "react-pdf";
import "./index.css";

function PdfIndex() {
  const { lineasActividad, loading } = useRegistroNota();

  if (loading) {
    return <Loader />;
  }

  console.log()

  return (
    <Document>
      <Page height="600px">
        <div className="Carga-notas-container">
          <BoletaPDF data={lineasActividad} />
        </div>
      </Page>
    </Document>
  );
}

export { PdfIndex };
