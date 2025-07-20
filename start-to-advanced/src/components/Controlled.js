import { useState, useRef } from "react";

export default function Controll({ setname }) {
  const [name, setName] = useState("");
  const [pass, setPass] = useState("");

  const [skills, setSkills] = useState({
    php: false,
    js: false,
    re: false,
  });

  const inputRef = useRef(null);

  function handleCheckboxChange(event) {
    const { id, checked } = event.target;
    setSkills((prev) => ({
      ...prev,
      [id]: checked,
    }));
  }

  const handleFocusClick = () => {
    inputRef.current.focus();
    inputRef.current.style.color = "red";
    inputRef.current.placeholder = "Enter the name";
    inputRef.current.value = "123";
  };

  const hantogle = () => {
    if (inputRef.current.style.display !== "none") {
      inputRef.current.style.display = "none";
    } else {
      inputRef.current.style.display = "inline";
    }
  };

  return (
    <div style={{ padding: "20px", maxWidth: "600px", margin: "0 auto" }}>
      <form onSubmit={(e) => e.preventDefault()}>
        <div style={{ marginBottom: "15px" }}>
          <input
            type="text"
            placeholder="Enter your Name"
            value={name}
            onChange={(e) => setName(e.target.value)}
            style={{ width: "100%", padding: "8px" }}
          />
        </div>

        <div style={{ marginBottom: "15px" }}>
          <input
            type="password"
            placeholder="Enter your password"
            value={pass}
            onChange={(e) => setPass(e.target.value)}
            style={{ width: "100%", padding: "8px" }}
          />
        </div>

        <div style={{ display: "flex", gap: "15px", marginBottom: "15px" }}>
          {Object.entries(skills).map(([skill, isChecked]) => (
            <div key={skill}>
              <input
                id={skill}
                type="checkbox"
                checked={isChecked}
                onChange={handleCheckboxChange}
              />
              <label htmlFor={skill}>
                {skill === "php"
                  ? "PHP"
                  : skill === "js"
                  ? "JavaScript"
                  : "React"}
              </label>
            </div>
          ))}
        </div>
      </form>

      <div
        style={{ marginTop: "20px", padding: "15px", border: "1px solid #ddd" }}
      >
        <h2>Name: {name}</h2>
        <p>Password: {"•".repeat(pass.length)}</p>
        <p>
          Selected Skills:{" "}
          {Object.entries(skills)
            .filter(([_, isChecked]) => isChecked)
            .map(([skill]) => {
              if (skill === "php") return "PHP";
              if (skill === "js") return "JavaScript";
              if (skill === "re") return "React";
              return skill;
            })
            .join(", ") || "None"}
        </p>
      </div>

      <button onClick={hantogle}>Toggle</button>

      <div style={{ marginTop: "20px" }}>
        <input
          ref={inputRef}
          type="text"
          placeholder="Focusable input"
          style={{ width: "100%", padding: "8px", marginBottom: "10px" }}
        />
        <button
          onClick={handleFocusClick}
          style={{ padding: "8px 16px", cursor: "pointer" }}
        >
          Focus the Input
        </button>
      </div>

      <h1>data From the Parent</h1>

      <input
        type="text"
        placeholder="Enter the Text"
        onChange={(e) => setname(e.target.value)}
      />
      
    </div>
  );
}
