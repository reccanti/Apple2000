import { InputHTMLAttributes } from "react";

interface InputProps extends InputHTMLAttributes<HTMLInputElement> {
  label: string;
}

export function BaseInput({ label, ...inputProps }: InputProps) {
  return (
    <label>
      {label}
      <input {...inputProps} />
    </label>
  );
}

export function Text(props: InputProps) {
  return <BaseInput {...props} type="text" />;
}

// Slider elements

interface SliderProps extends InputProps {
  onUpdate?: (value: number) => void;
}

export function Slider({ onUpdate = () => {}, ...props }: SliderProps) {
  const handleInput: SliderProps["onChange"] = (event) => {
    const value = Number(event.target.value);
    onUpdate(value);
    if (props.onInput) {
      props.onInput(event);
    }
  };

  return <BaseInput {...props} onInput={handleInput} type="range" />;
}
